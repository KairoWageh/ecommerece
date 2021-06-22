<!-- Delete user modal start -->
<div id="delete_user_modal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <h4 class="modal-title w-100">{{__('are_you_sure')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>{{__('confirm')}}</p>
                <form>
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id_to_delete" class="user_id_to_delete">
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('cancel')}}</button>
                <button type="button" class="btn btn-danger delete_user_confirm">{{__('delete')}}</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete user modal end -->
