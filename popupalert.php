<style>
.flight-modal {
    border-radius: 14px;
}

.icon-box {
    width: 70px;
    height: 70px;
    margin: 0 auto;
    border-radius: 50%;
    background: #fff3cd;
    color: #ff9800;
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.flight-modal h4 {
    font-weight: 600;
    color: #333;
}

.flight-modal p {
    font-size: 14px;
}

.flight-modal .btn-primary {
    background: #0d6efd;
    border-radius: 25px;
}
</style>

<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content flight-modal">

      <div class="modal-body text-center p-4">
        <div class="icon-box mb-3">
          ✈️
        </div>

        <h4 class="mb-2">No Flights Available</h4>
        <p class="text-muted mb-4">
          Sorry! We couldn’t find any flights for your selected route and dates.
          Please try different dates or search again.
        </p>

        <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal" onclick="$('#statusModal').modal('hide');">
          Search Again
        </button>
      </div>

    </div>
  </div>
</div>