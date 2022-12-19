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
                                                    <select class="form-control single " data-skip-name="true" data-name="game[]" required>
                                                        <option value="">Select Game</option>
                                                        @foreach ($games as $game)
                                                            <option value="{{ $game->id }}" {{ $game->id == $bonushuntgame->game_id ? 'selected' : '' }}>{{ $game->slot_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Bet</label>
                                                    <input type="text" value="{{ $bonushuntgame->bet }}" data-name="bet[]" name="bet" id="bet" class="form-control"
                                                        required />
                                                </div>
                                                <div class="col-md-3" id="res1">
                                                    <label>Result</label>
                                                    <input type="text" data-cenk="{{ $bonushuntgame->id }}" data-name="result[]" value="{{ $bonushuntgame->result }}"
                                                        name="result" id="result" class="form-control result" required />
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="col-md-3" style="margin-top:24px;" align="left">
                                        <a data-id="{{ $bonushuntgame->id }}" class="btn btn-primary repeater_form">Save</a>
                                    </div>
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

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
            document.addEventListener("DOMContentLoaded", () => {
                $('body').on('click', '.saveGameResult', function(e) {
                    e.preventDefault();


                    //var game_id = $(this).attr("data-id");

                    //let result = $('data-res="' + game_id + '"]');
                    // let result = document.querySelectorAll('[data-res="' + game_id + '"]');

                    jQuery('input[name*="result"]').each(function(e) {
                        console.log($(this).val());
                    });


                    return;
                });


            });
        </script>
        <script>
            $(document).ready(function() {





                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#addMore").click(function(e) {
                    e.preventDefault();

                    setTimeout(function() {
                        $(".single").select2({
                            placeholder: "Select a game",
                            allowClear: true,
                        });

                    }, 100);

                });

                $("#repeater").createRepeater();
                $(".single").select2({
                    placeholder: "Select a game",
                    allowClear: true,
                });


                $('#repeater_form').on('submit', function(event) {

                    jQuery('input[name*="result"]').each(function(e) {
                        let data = +$(this).val();
                    });
                    console.log(data);
                    return;

                    event.preventDefault();
                    $.ajax({
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
                });


                $(document).on('select2:open', () => {
                    document.querySelector('.select2-search__field').focus();
                });

            });
        </script>
</x-app-layout>
