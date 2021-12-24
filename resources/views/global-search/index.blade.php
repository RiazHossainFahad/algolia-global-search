<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Global Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 my-5">
                <select class="select2 form-control"></select>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                delay: 250,
                minimumInputLength: 3,
                ajax: {
                    method: 'get',
                    url: "{{ route('global-search.search') }}",
                    data: function (params) {
                        const queryParameters = {
                            q: params.term
                        }

                        return queryParameters;
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data,
                            // pagination: {
                            //     more: (params.page * 30) < data.total_count
                            // }
                        };
                    },
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateResult: formatItem,
                templateSelection: formatItemSelection,
            });

            function formatItem(item) {
                if (item.loading) {
                    return 'Searching! Please wait...';
                }

                let markup = `<div class="searchable-link" href="${item.action_url}">`;
                markup += `<div class="searchable-title">${item.model}</div>`;
                $.each(item.formatted_fields, (el, field) => {
                    let f = 'name';
                    markup += `<div class="searchable-fields">${field}: ${item[el]}</div>`;
                })

                markup += `</div>`;

                return markup;
            }

            function formatItemSelection(item) {
                if (!item.model) {
                    return 'Searching! Please wait...';
                }

                return item.model;
            }
        });
    </script>
</body>
</html>