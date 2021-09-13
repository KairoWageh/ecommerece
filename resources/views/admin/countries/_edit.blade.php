<!-- Edit country modal start -->
<div class="modal fade" id="edit_country_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{__('edit_admin')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class ="validation-errors"></div>


            <form id="edit_country_form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="country_id" class="form-control country_id_to_edit" id="country_id" value="">
                    </div>
                    <div class="form-group">
                        <label for="edit_country_name_ar">{{__('name_ar')}}</label>
                        <input type="text" name="edit_country_name_ar" class="form-control @error('edit_country_name_ar') is-invalid @enderror" id="edit_country_name_ar" placeholder="{{__('name_ar')}}">
                        @error('edit_country_name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_country_name_en">{{__('name_en')}}</label>
                        <input type="text" name="edit_country_name_en" class="form-control @error('edit_country_name_en') is-invalid @enderror" id="edit_country_name_en" placeholder="{{__('name_en')}}">
                        @error('edit_country_name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_country_code">{{__('country_code')}}</label>
                        <input type="text" name="edit_country_code" class="form-control @error('edit_country_code') is-invalid @enderror" id="edit_country_code" placeholder="{{__('country_code')}}">
                        @error('edit_country_code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_country_iso_code">{{__('country_iso_code')}}</label>
                        <input type="text" name="edit_country_iso_code" class="form-control @error('edit_country_iso_code') is-invalid @enderror" id="edit_country_iso_code" placeholder="{{__('country_iso_code')}}">
                        @error('edit_country_iso_code')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_country_currency">{{__('country_currency')}}</label>
                        <input type="text" name="edit_country_currency" class="form-control @error('edit_country_currency') is-invalid @enderror" id="edit_country_currency" placeholder="{{__('country_currency')}}">
                        @error('edit_country_currency')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('edit')}}</button>
                </div>
            </form>
        </div>

    </div>
</div>
