 <!-- Modal -->
 <div id="myModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content">
             {{-- <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">@lang('New Reservation')</h4>
             </div> --}}
             <div class="modal-body text-center">
                 <div class="">

                     <input type="hidden" id="resvLnk" name="resvLnk" value="{{ url('admin/reservations/edit') }}" />
                     <input type="hidden" id="myStore" name="myStore"
                         value="{{ auth()->user() && auth()->user()->store ? auth()->user()->store->id : null }}" />
                     <div class="row alert alert-success" id="newResDiv" style="display: none"></div>
                     <div class="row alert alert-danger" id="cancelResDiv" style="display: none"></div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
             </div>
         </div>
     </div>
 </div>
