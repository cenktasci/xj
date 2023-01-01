<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            BONUS HUNT - {{ $bonushunt->bonus_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="post" id="repeater_form">
                        <input type="hidden" data-name="bonushunt_id[]" name="bonushunt_id" value="{{ $bonushunt->id }}" class="form-control" required />

                        <div id="repeater">
                            <div class="repeater-heading" align="right">
                                <a class="btn btn-primary totalwin">Total X - <b class="totalx">{{ $multi }}</b> KATI</a>
                                <a class="btn btn-primary totalwin">Total Win: - <b class="totalsum">{{ $total }}</b>,00 ₺</a>
                            </div>
                            <hr>
                            <div class="clearfix"></div>
                            <div class="items" data-group="bet">
                                <div class="item-content">
                                    @foreach ($bonushuntgame as $bonushuntgame)
                                        <div class="form-group">
                                            <div class="row">


                                                <div class="col-md-3">
                                                    <label>Game Select</label>
                                                    <select class="form-control single " data-skip-name="true" data-name="game[]" required>
                                                        <option value="">Select Game</option>
                                                        @foreach ($games as $game)
                                                            <option value="{{ $game->id }}" {{ $game->id == $bonushuntgame->game_id ? 'selected' : '' }}>
                                                                {{ $game->slot_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Bet</label>
                                                    <input type="text" data-cenk1="{{ $bonushuntgame->id }}" value="{{ $bonushuntgame->bet }}" data-name="bet[]" name="bet"
                                                        id="bet" class="form-control" required />
                                                </div>
                                                <div class="col-md-3" id="res1">
                                                    <label>Result</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">₺</span>
                                                        <input type="number" class="form-control"data-cenk="{{ $bonushuntgame->id }}" data-name="result[]"
                                                            value="{{ $bonushuntgame->result }}"name="result" id="result" class="form-control result" required>
                                                        <span class="input-group-text">,00</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3" style="margin-top:24px;" align="left">
                                                    <a data-id="{{ $bonushuntgame->id }}" class="btn btn-primary saveResult">Save</a>

                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="form-group" align="left">
                            <br /><br />

                        </div>
                    </form>



                </div>
            </div>
        </div>
        <script src="http://demo.webslesson.info/dynamic-input-fields/repeater.js" type="text/javascript"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        <style>
            .select2-container--default .select2-selection--single {
                height: 38px !important;
                padding: 8px 12px;
                font-size: 18px;
                line-height: 1.23;
                border-radius: 6px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow b {
                top: 70% !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 20px !important;
            }

            .select2-container--default .select2-selection--single {
                border: 1px solid #CCC !important;
                box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
                transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
            }
        </style>
        <script>
            $(document).ready(function() {



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(".saveResult").click(function(e) {
                    e.preventDefault();
                    $('.saveResult').prop('disabled', true);



                    let bonus_hunts_id = "{{ $bonushunt->id }}";
                    let game_id = $(this).attr("data-id");
                    let bet = $('input[data-cenk1="' + game_id + '"]').val();
                    let result = $('input[data-cenk="' + game_id + '"]').val();



                    let dataString = 'bet=' + bet + '&game_id=' + game_id + '&result=' + result + '&bonus_hunts_id=' + bonus_hunts_id;
                    document.querySelector('.saveResult').disabled = true;
                    $.ajax({
                        url: "{{ route('bonushuntGame.update', $bonushuntgame->id) }}",
                        method: "PUT",
                        data: dataString,
                        success: function(res) {
                            const test = JSON.parse(res);
                            //console.log(test);

                            //result_avg

                            var a = $("b.totalsum").text();
                            var b = $("b.totalx").text();

                            if (b != test.multiplier) {
                                $("b.totalx").text("");
                                $("b.totalx").text(test.multiplier);
                            }

                            if (a != test.totalresult) {
                                $("b.totalsum").text("");
                                $("b.totalsum").text(test.totalresult);
                            }
                            //totalsum

                            if (test.response == 1) {
                                $('.saveResult').prop('disabled', false);

                                Toastify({
                                    text: "Result Saved",
                                    offset: {
                                        x: 50, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                                        y: 10 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                                    },
                                }).showToast();



                            }
                        }
                    });

                });



                /*
                   let save =    $.ajax({
                        url: "{{ route('bonushuntGame.update', $bonushuntgame->id) }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            $('#repeater_form')[0].reset();
                            $("#repeater").createRepeater();
                            $('#success_result').html(data);
                            setInterval(function() {
                                window.location.href = "{{ url('/bonushunt') }}"
                            }, 1020);
                        }
                    });
                    */


                $(document).on('select2:open', () => {
                    document.querySelector('.select2-search__field').focus();
                });

            });
        </script>
</x-app-layout>
