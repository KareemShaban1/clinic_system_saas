@extends('backend.dashboards.clinic.layouts.master')

@section('title')
    {{ trans('backend/patients_trans.Add_Patient') }}
@stop

@section('page-header')
    <h4 class="page-title">{{ trans('backend/patients_trans.Add_Patient') }}</h4>
@endsection

@section('content')

<div class="row mb-4">
    <div class="col-md-6">
        <input type="text" id="patient_code" class="form-control" placeholder="Enter Patient Code">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary" onclick="searchPatient()">Search</button>
    </div>
    <div class="col-md-4 text-end">
        <button class="btn btn-success" onclick="startScan()">Scan QR Code</button>
    </div>
</div>

<div id="patient_result" style="display:none;">
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> <span id="patient_name"></span></p>
            <p><strong>Email:</strong> <span id="patient_email"></span></p>
            <button class="btn btn-info" onclick="assignPatient()">Assign to Clinic</button>
        </div>
    </div>
</div>

<!-- QR Code Scanner Modal -->
<div id="scannerModal" style="display: none;">
    <video id="preview" style="width: 100%; height: auto;"></video>
</div>


@endsection

@push('scripts')
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    function searchPatient() {
        let code = document.getElementById('patient_code').value;
        if (!code) return alert('Enter a patient code');

        fetch(`/clinic/patients/search?code=${code}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('patient_result').style.display = 'block';
                    document.getElementById('patient_name').innerText = data.patient.name;
                    document.getElementById('patient_email').innerText = data.patient.email;
                    document.getElementById('patient_result').dataset.id = data.patient.id;
                } else {
                    alert(data.message);
                }
            });
    }

    function assignPatient() {
        let patientId = document.getElementById('patient_result').dataset.id;
        fetch('/clinic/patients/assign', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ patient_id: patientId })
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
        });
    }

    function startScan() {
        document.getElementById('scannerModal').style.display = 'block';
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        console.log(scanner);
        scanner.addListener('scan', function (content) {
            console.log(content)
            document.getElementById('patient_code').value = content;
            scanner.stop();
            document.getElementById('scannerModal').style.display = 'none';
            searchPatient();
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }
        }).catch(function (e) {
            console.error(e);
            alert('Error accessing camera');
        });
    }
</script>
@endpush
