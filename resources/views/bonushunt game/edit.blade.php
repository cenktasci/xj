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
                                <button type="button" id="addMore" class="btn btn-primary repeater-add-btn">Add More Games</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="items" data-group="bet">
                                <div class="item-content">
                                    @foreach ($bonushuntgame as $bonushuntgame)
                                    <div class="form-group">
                                        <div class="row">


                                            <div class="col-md-3">
                                                <label>Game Select</label>
                                                <select disabled class="form-control single " data-skip-name="true" data-name="game[]" required>
                                                    <option value="">Select Game</option>
                                                    @foreach ($games as $game)
                                                    <option value="{{ $game->id }}" {{ $game->id == $bonushuntgame->game_id ? 'selected' : '' }}>{{ $game->slot_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Bet</label>
                                                <input type="text" data-cenk1="{{ $bonushuntgame->id }}" value="{{ $bonushuntgame->bet }}" data-name="bet[]" name="bet" id="bet" class="form-control" required />
                                            </div>
                                            <div class="col-md-3" id="res1">
                                                <label>Result</label>
                                                <input type="text" data-cenk="{{ $bonushuntgame->id }}" data-name="result[]" value="{{ $bonushuntgame->result }}" name="result" id="result" class="form-control result" required />
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

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
       
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                Swal.fire(
                    'Good job!',
                    'You clicked the button!',
                    'success'
                )
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(".saveResult").click(function(e) {
                    e.preventDefault();

                    let bonus_hunts_id = "{{ $bonushunt->id }}";
                    let game_id = $(this).attr("data-id");
                    let bet = $('input[data-cenk1="' + game_id + '"]').val();
                    let result = $('input[data-cenk="' + game_id + '"]').val();


                    let dataString = 'bet=' + bet + '&game_id=' + game_id + '&result=' + result + '&bonus_hunts_id=' + bonus_hunts_id;

                    $.ajax({
                        url: "{{ route('bonushuntGame.update', $bonushuntgame->id) }}",
                        method: "PUT",
                        data: dataString,
                        success: function(res) {
                            if (res == 1) {
                                toast.info('Your Post as been submited!');

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