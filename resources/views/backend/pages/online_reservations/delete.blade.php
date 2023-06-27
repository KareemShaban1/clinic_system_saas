<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_receipt{{$online_reservation->meeting_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">حذف {{$online_reservation->topic}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('backend.online_reservations.destroy','test')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$online_reservation->id}}">
                    <input type="hidden" name="meeting_id" value="{{$online_reservation->meeting_id}}">
                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد مع عملية الحذف ؟</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('backend/online_reservations_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('backend/online_reservations_trans.Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
