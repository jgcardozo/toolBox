{{-- 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#componentModal">
  Launch demo modal
</button> 
https://www.youtube.com/watch?v=u7FN-9vZfIA&list=PLZ2ovOgdI-kWWS9aq8mfUDkJRfYib-SvF&index=34
--}}


<div class="modal fade" id="componentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $body }}
            </div>
            <div class="modal-footer">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>
