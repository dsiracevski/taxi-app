<div class="modal" id="addScheduledRoute">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Закажи Возило -->
            <div class="modal-header">
                <div class="row">
                    <div class="col-12">
                        <h4 class="modal-title">Закажи возило</h4>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('storeBooking')}}" method="POST" id="scheduleDirection">
                    @csrf
                    <div class="row">
                        <div class="form-group col-4">
                            <input type="text" placeholder="Име" name="name" class="form-control" required>
                        </div>

                        <div class="col-4">
                            <select name="frequency" class="form-control" id="" required>
                                <option value="">Закажи</option>
                                <option value="once">Еднаш</option>
                                <option value="daily">Секојдневно</option>
                                <option value="monthly">Месечно</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" placeholder="Почнува на" name="start_date"
                                   id="datetimepicker6" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-8">
                            <textarea placeholder="Забелешка" class="w-100 form-control" name="note"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Откажи</button>
                        </div>
                        <div class="col-6 text-center">
                            <button type="submit" class="btn btn-primary">Додади</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
