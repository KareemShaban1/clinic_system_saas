<div class="row pt-4">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <form action="{{ Route('backend.prescription.store') }}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf


                    <br>

                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 child-repeater-table">
                            <table class="table table-bordered table-responsive" id="table">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ trans('backend/drugs_trans.Drug_Name') }}</th>
                                        <th>{{ trans('backend/drugs_trans.Drug_Dose') }}</th>
                                        <th>{{ trans('backend/drugs_trans.Drug_Type') }}</th>
                                        <th>{{ trans('backend/drugs_trans.Frequency') }}</th>
                                        <th>{{ trans('backend/drugs_trans.Period') }}</th>
                                        <th>{{ trans('backend/drugs_trans.Notes') }}</th>
                                        <th><a href="javascript:void(0)" class="btn btn-success addRow">
                                                {{ trans('backend/drugs_trans.Add_Drug') }}
                                            </a></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr>

                                        <td>
                                            <input class="form-control" name="id[]" hidden
                                                value="{{ $reservation->id }}" type="text">
                                        </td>
                                        <td>
                                            <input type="text" name="drug_name[]" class="form-control" style="width:120px"
                                                placeholder="{{ trans('backend/drugs_trans.Drug_Name') }}">
                                            @error('drug_name')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="drug_dose[]" class="form-control" style="width:120px"
                                                placeholder="{{ trans('backend/drugs_trans.Drug_Dose') }}">
                                            @error('drug_dose')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="drug_type[]" class="form-control" style="width:120px"
                                                placeholder="{{ trans('backend/drugs_trans.Drug_Type') }}">
                                            @error('drug_type')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="frequency[]" class="form-control" style="width:120px"
                                                placeholder="{{ trans('backend/drugs_trans.Frequency') }}">
                                            @error('frequency')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="period[]" class="form-control" style="width:120px"
                                                placeholder="{{ trans('backend/drugs_trans.Period') }}">
                                            @error('period')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text" name="notes[]" class="form-control" style="width:200px"
                                                placeholder="{{ trans('backend/drugs_trans.Notes') }}">
                                            @error('notes')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">
                                                {{ trans('backend/drugs_trans.Delete') }} </a></th>

                                    </tr>
                                </tbody>


                            </table>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('backend/drugs_trans.Save') }}</button>

                </form>

            </div>
        </div>
    </div>
</div>
