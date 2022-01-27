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
                <form action="{{route('storeBooking')}}" method="POST" id="direction">
                    @csrf
                    <div class="row">
                        <div class="form-group col-4">
                            <input type="text" placeholder="Име" name="name" class="form-control">
                        </div>

                        <div class="col-4">
                            <select name="frequency" class="form-control" id="">
                                <option value="">Закажи</option>
                                <option value="once">Еднаш</option>
                                <option value="daily">Секојдневно</option>
                                <option value="monthly">Месечно</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control" placeholder="Почнува на" name="start_date"
                                   id="datetimepicker6">
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

@section('script')
    <script>
        $(document).ready(function () {
            $(".directions tr").on("click", function () {
                //get id
                let id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "/directions/single/" + id,
                    success: function (data) {
                        for (item in data.data) {
                            $("[name=" + item).val(data.data[item])
                        }
                        $("#direction").attr('action', '/directions');
                        $("#direction button[type=submit]").html('Зачувај');
                        $('#direction').append('<input type="hidden" name="_method" value="put" />');
                        $('#direction').append('<input type="hidden" name="id" value="' + id + '" />');
                        $("#addRoute").modal();
                        console.log(data.data);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
                alert(id);
            });
            $('#addRoute').on('hidden.bs.modal', function () {
                $('#direction')[0].reset();
                $("[name=id]").remove();
                $("[name=_method]").remove();
            });

            $('#datetimepicker6').datetimepicker({
                lang: 'mk',
                step: 5
            });
        });
    </script>
@stop
