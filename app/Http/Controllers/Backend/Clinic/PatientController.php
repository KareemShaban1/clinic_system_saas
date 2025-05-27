<?php

namespace App\Http\Controllers\Backend\Clinic;

use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Settings;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Scopes\ClinicScope;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\AuthorizeCheck;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\OrganizationAssignment;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Backend\StorePatientRequest;
use App\Http\Requests\Backend\UpdatePatientRequest;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class PatientController extends Controller
{
    use AuthorizeCheck;

    protected $patient;
    protected $reservation;
    protected $settings;

    public function __construct(Patient $patient, Reservation $reservation, Settings $settings)
    {
        $this->patient = $patient;
        $this->reservation = $reservation;
        $this->settings = $settings;
    }

    // function to show all patients
    public function index()
    {
        $this->authorizeCheck('view-patients');


        $patients = Patient::with('reservations')->get();

        return view('backend.dashboards.clinic.pages.patients.index', compact('patients'));
    }

    public function data()
    {
        $patients = Patient::with('reservations')->clinic()->get();

        return DataTables::of($patients)
            ->addColumn('number_of_reservations', function ($patient) {
                return $patient->reservations->count();
            })
            ->addColumn('add_reservation', function ($patient) {
                return '<a href="' . route('clinic.reservations.add', $patient->id) . '"
                            class="btn btn-info btn-sm">
                            ' . trans('backend/patients_trans.Add_Reservation') . '
                        </a>';
            })
            ->addColumn('add_online_reservation', function ($patient) {
                return '<a href="' . route('clinic.online_reservations.add', $patient->id) . '"
                            class="btn btn-info btn-sm">
                            ' . trans('backend/patients_trans.Add_Online_Reservation') . '
                        </a>';
            })
            ->addColumn('patient_card', function ($patient) {
                return '<a href="' . route('clinic.patients.patient_pdf', $patient->id) . '"
                            class="btn btn-primary btn-sm">
                            ' . trans('backend/patients_trans.Show_Patient_Card') . '
                        </a>';
            })
            ->addColumn('action', function ($patient) {
                $editUrl = route('clinic.patients.edit', $patient->id);
                $deleteUrl = route('clinic.patients.destroy', $patient->id);
                $viewUrl = route('clinic.patients.show', $patient->id);
                // $assignUrl = route('clinic.patients.assignPatient', $patient->id);
                $unassignUrl = route('clinic.patients.unassignPatient', $patient->id);

                $actions = '
                    <a href="' . $viewUrl . '" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    ';

                if ($patient->reservations->count() == 0) {
                    $actions .= '
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Are you sure you want to delete this item?\')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <form action="' . $unassignUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('POST') . '
                            <button type="submit" class="btn btn-secondary btn-sm"
                                    onclick="return confirm(\'Are you sure you want to unassign this item?\')">
                                <i class="fa fa-link-slash"></i>
                            </button>
                        </form>';
                }

                return $actions;
            })
            ->rawColumns(['add_reservation', 'add_online_reservation', 'patient_card', 'action'])
            ->make(true);
    }


    // show user data based on id
    public function show($id)
    {
        $this->authorizeCheck('view-patients');

        // get patient with his reservations based on id
        $patient = $this->patient->withCount('reservations')->findOrFail($id);


        return view('backend.dashboards.clinic.pages.patients.show', compact('patient'));
    }

    public function patientPdf($id)
    {
        $patient = $this->patient->find($id);

        // get settings of the app from settings table
        $collection = $this->settings->select('key', 'value')->get();
        $settings = $collection->pluck('value', 'key');

        $data = [
            'patient' =>  $patient,
            'settings' => $settings
        ];

        $pdf = PDF::loadView(
            'backend.dashboards.clinic.pages.patients.patient_card',
            $data,
            [],
            [
                // 'format' => 'A5-L',
                'format' => [190, 100] // W - H
            ]
        );
        return $pdf->stream($patient->name . '.pdf');
    }

    public function add()
    {
        $this->authorizeCheck('add-patient');

        return view('backend.dashboards.clinic.pages.patients.add');
    }


    public function store(StorePatientRequest $request)
    {

        $this->authorizeCheck('add-patient');

        try {


            $data = $request->validated();

            $data['password'] = Hash::make($request->password);

            $patient = Patient::create($data);

            DB::table('patient_organization')->insert([
                'patient_id' => $patient->id,
                'organization_id' => auth()->user()->organization->id,
                'organization_type' => Clinic::class,
                'assigned' => true,
            ]);


            // Send WhatsApp notification with credentials
            $this->sendPatientCredentialsWhatsApp($patient, $request->password);



            return redirect()->route('clinic.patients.index')->with('toast_success', 'Patient added toast_successfully');
        } catch (\Exception $e) {

            // dd($e);
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }




    /**
    * Send WhatsApp notification to patient with credentials and clinic info
    */
    private function sendPatientCredentialsWhatsApp($patient, $plainPassword)
    {
        try {
            $clinicName = auth()->user()->organization->name ?? 'Our Clinic';

            // Format phone number for WhatsApp chat ID format
            $chatId = "201127447085";

            // Prepare the message
            $message = "🏥 Welcome to {$clinicName}!\n\n";
            $message .= "Dear {$patient->name},\n\n";
            $message .= "Your account has been created successfully. Here are your login credentials:\n\n";
            $message .= "📧 Email: {$patient->email}\n";
            $message .= "🔐 Password: {$plainPassword}\n\n";
            $message .= "You can now access our patient portal to:\n";
            $message .= "• View your appointments\n";
            $message .= "• Access medical records\n";
            $message .= "• Communicate with our team\n\n";
            $message .= "Please keep your credentials secure and change your password after first login.\n\n";
            $message .= "If you have any questions, feel free to contact us.\n\n";
            $message .= "Best regards,\n{$clinicName} Team";

            // Send via Hypersender using cURL
            $this->sendWhatsAppMessage($chatId, $message);

        } catch (\Exception $e) {
            \Log::error("WhatsApp notification error for patient {$patient->email}: " . $e->getMessage());
            // Don't throw exception to prevent patient creation from failing
        }
    }

    /**
    * Send WhatsApp message using Hypersender API
    */
    private function sendWhatsAppMessage($chatId, $message)
    {
        $instance = "9f019bb4-dc27-4d6f-bb58-4e627e1cabfb" ;// Your instance ID
        $token = "240|6CASHwjIGSUGGHVDuPpZCZKfivVV8kixl7aIPOFc53b42a26";

        $url = "https://app.hypersender.com/api/whatsapp/v1/{$instance}/send-text";

        $postData = json_encode([
            'chatId' => $chatId,
            'text' => $message,
            'link_preview' => false
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . $token
            ),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            \Log::error('cURL Error sending WhatsApp message: ' . $error);
            return false;
        }

        if ($httpCode == 201 || $httpCode == 200) {
            \Log::info('WhatsApp message sent successfully', ['response' => $response]);
            return true;
        } else {
            \Log::error('Failed to send WhatsApp message', [
                'http_code' => $httpCode,
                'response' => $response,


            ]);
            return false;
        }
    }

    /**
    * Format phone number for WhatsApp (ensure country code is present)
    */
    private function formatPhoneNumber($phone)
    {
        // Remove any spaces, dashes, or special characters
        $phone = preg_replace('/[^0-9+]/', '', $phone);

        // If phone doesn't start with +, add your default country code
        // Adjust this based on your region (example shows +1 for US/Canada)
        if (!str_starts_with($phone, '+')) {
            // Add your default country code here
            $phone = '+1' . ltrim($phone, '0');
        }

        return $phone;
    }





    public function edit($id)
    {
        $this->authorizeCheck('edit-patient');

        $patient = $this->patient->findOrFail($id);

        return view('backend.dashboards.clinic.pages.patients.edit', compact('patient'));
    }


    public function update(UpdatePatientRequest $request, $id)
    {

        $this->authorizeCheck('edit-patient');

        try {
            $request->validated();

            $data = $request->all();

            $patient = $this->patient->findOrFail($id);

            $patient->update($data);

            return redirect()->route('clinic.patients.index')->with('toast_success', 'Patient added toast_successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    public function destroy($id)
    {
        $this->authorizeCheck('delete-patient');

        $patient = $this->patient->findOrFail($id);

        $patient->delete();

        return redirect()->route('clinic.patients.index');
    }



    public function trash()
    {
        $this->authorizeCheck('delete-patient');

        $patients = $this->patient->onlyTrashed()->get();
        return view('backend.dashboards.clinic.pages.patients.trash', compact('patients'));
    }

    public function trashData()
    {
        $patients = $this->patient->onlyTrashed()->get();
        return DataTables::of($patients)
            ->addColumn('action', function ($patient) {
                $restoreUrl = route('backend.patients.restore', $patient->id);
                $forceDeleteUrl = route('backend.patients.forceDelete', $patient->id);

                $actions = '
                <a href="' . $restoreUrl . '" class="btn btn-info btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
                <form action="' . $forceDeleteUrl . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm(\'Are you sure you want to delete this item?\')">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>';
                return $actions;
            })

            ->rawColumns(['restore', 'force_delete'])
            ->make(true);
    }



    public function restore($id)
    {
        $this->authorizeCheck('restore-patient');

        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        $patients->restore();

        return redirect()->route('clinic.patients.index');
    }


    public function forceDelete($id)
    {

        $this->authorizeCheck('force-delete-patient');

        $patients = $this->patient->onlyTrashed()->findOrFail($id);

        $patients->forceDelete();

        return redirect()->route('clinic.patients.index');
    }

    public function add_patient_code()
    {
        return view('backend.dashboards.clinic.pages.patients.add_patient_code');
    }


    public function search(Request $request)
    {
        $patient = Patient::where('patient_code', $request->code)->first();

        if (!$patient) {
            return response()->json([
                'success' => false,
                'message' => 'Patient not found.'
            ]);
        }

        // Load only assigned medical laboratories
        $assignedLabs = $patient->clinics()
            ->wherePivot('assigned', 1)
            ->get();

        foreach ($assignedLabs as $medicalLab) {
            if ($medicalLab->id == auth()->user()->organization->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Patient already assigned to your clinic.'
                ]);
            }
        }

        // Patient found and not assigned to this lab
        return response()->json([
            'success' => true,
            'patient' => $patient
        ]);
    }



    public function assignPatient(Request $request)
    {

        DB::table('patient_organization')->insert([
            'patient_id' => $request->patient_id,
            'organization_id' => auth()->user()->organization->id,
            'organization_type' => Clinic::class,
            'assigned' => 1,
        ]);


        return response()->json(['message' => 'Patient assigned successfully']);
    }

    public function unassignPatient($patient_id)
    {
        DB::table('patient_organization')
            ->where('patient_id', $patient_id)
            ->update([
                'assigned' => 0,
            ]);


        return redirect()->back()->with('toast_success', 'Patient unassigned successfully');

    }
}
