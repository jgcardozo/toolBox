<!-- Modal -->
<div wire:ignore.self class="modal fade" id="detailModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($loadingDetail)

                    <div class="spinner-border text-info" role="status"></div>
            
                @else
                    <div class="table-wrapper">
                        <table class="table table-striped table-sm">
                            <thead class="bg-dark">
                                <tr class="text-sm">
                                    <th scope="col">#</th>
                                    <th scope="col">Coupon</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">AffiliateID</th>
                                    <th scope="col">DateTime</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($couponDetail as $item)
                                    <tr class="text-sm">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->coupon }}</td>
                                        <td>{{ $item->affiliate }}</td>
                                        <td>{{ $item->affiliate_id }}</td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div><!-- modal-body -->

            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-sm btn-dark close-btn" data-dismiss="modal"><i
            class="fas fa-solid fa-xmark-circle mr-2"></i>Close</button> --}}
                <button wire:loading.attr="disabled" wire:target="exportToExcel" type="button"
                    wire:click.prevent="exportToExcel()" class="btn btn-sm btn-success disabled:opacity-50">Export <i
                        class="fa fa-file-excel ml-2"></i></button>
            </div>
            @endif

        </div>


    </div>
</div>
