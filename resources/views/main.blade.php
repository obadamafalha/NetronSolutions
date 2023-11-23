<!DOCTYPE html>

<html>

<head>

    <title>Offers</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">


    <style>
        svg {
            color: #0b54e6;
        }

        svg:hover {
            color: #1e40af;
            transform: scale(1.1);
        }
    </style>
</head>


<body>

    <div class="container">
        <div class="card">

            <div class="card-header" style="padding-top: 20px;">

                <h1 style="text-align: center">Offers</h1>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="order">Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Add Offer</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">

                <table class="table table-hover" id="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <td>Caree</td>
                            <td>Total Price</td>
                            <td>Cabin Class</td>
                            <td>DepFrom</td>
                            <td>ArrTo</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($finalResult as $item)
                            <tr>
                                <th scope="row">{{ $item['flight_code'] }}</th>
                                <td>{{ $item['caree'] }}</td>
                                <td>{{ $item['total_price'] }}</td>
                                <td>{{ $item['cabin_class'] }}</td>
                                <td>
                                    @if (is_array($item['dep_from']))
                                        @foreach ($item['dep_from'] as $item2)
                                            <div class="row">
                                                {{ $item2['DepFrom'] }}
                                            </div>
                                        @endforeach
                                    @else
                                        {{ $item['dep_from'] }}
                                    @endif
                                </td>
                                <td>
                                    @if (is_array($item['arr_to']))
                                        @foreach ($item['arr_to'] as $item2)
                                            <div class="row">
                                                {{ $item2['ArrTo'] }}
                                            </div>
                                        @endforeach
                                    @else
                                        {{ $item['arr_to'] }}
                                    @endif
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        var table = $('#table').DataTable();
    });
</script>

</html>
