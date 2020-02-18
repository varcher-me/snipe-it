<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>入库记录单</title>
    <style>
        body {
            font-family: "Arial, Helvetica", sans-serif;
        }
        table.inventory {
            border: solid #000;
            border-width: 1px 1px 1px 1px;
            width: 100%;
        }

        @page {
            size: A4;
        }
        table.inventory th, table.inventory td {
            border: solid #000;
            border-width: 0 1px 1px 0;
            padding: 3px;
            font-size: 12px;
        }

        .print-logo {
            max-height: 40px;
        }

    </style>
</head>
<body>

@if ($snipeSettings->logo_print_assets=='1')
    @if ($snipeSettings->brand == '3')

        <h3>
        @if ($snipeSettings->logo!='')
            <img class="print-logo" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
        @endif
        {{ $snipeSettings->site_name }}
        </h3>
    @elseif ($snipeSettings->brand == '2')
        @if ($snipeSettings->logo!='')
            <img class="print-logo" src="{{ url('/') }}/uploads/{{ $snipeSettings->logo }}">
        @endif
    @else
      <h3>{{ $snipeSettings->site_name }}</h3>
    @endif
@endif

<h4>IT固定资产入库单</h4>

<table class="inventory">
    <thead>
        <tr>
            <th style="width: 20px;"></th>
            <th style="width: 20%;">资产编号</th>
            <th style="width: 20%;">型号</th>
            <th style="width: 10%;">序列号</th>
        </tr>
    </thead>

@foreach ($assets as $asset)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $asset->asset_tag }}</td>
        <td>{{ $asset->model->model_number }}</td>
        <td>{{ $asset->serial }}</td>
    </tr>
@endforeach
</table>

<br>
<br>
<br>
<table>
    <tr>
        <td>Signed Off By:</td>
        <td>________________________________________________________</td>
        <td></td>
        <td>Date:</td>
        <td>________________________________________________________</td>
    </tr>
</table>


</body>
</html>
