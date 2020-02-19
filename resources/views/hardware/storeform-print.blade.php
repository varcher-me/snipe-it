<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Style-Type" content="text/css" />
    <title></title>
</head>
<body style="margin-left: 200px; margin-right: 200px; margin-top: 125px;">
<div>
    <img src="{{ url('/').'/uploads/companies/'.$company->image }}" height=75px>
</div>
<div>
    <hr style="height:1px;border:none;border-top:1px solid #555555;" />
</div>
<div align="center">
    <p style="margin-top:8px; text-align:center"><span style="font-family:方正小标宋简体; font-size:32pt">国寿健康产业投资有限公司</span></p>
    <p style="margin-top:8px; orphans:0; text-align:center; widows:0"><span style="font-family:方正小标宋简体; font-size:32pt">IT固定资产入库单</span></p>
    <p style="margin-bottom:8px; margin-right: 60px; orphans:0;  text-align: right; widows:0"><span style="font-family:方正小标宋简体; font-size:24pt">编号：<u>{{ $form_tag }}</u></span></p>
    <p style="margin-bottom:50px; margin-right: 60px; orphans:0; text-align: right; widows:0"><span style="font-family:方正小标宋简体; font-size:24pt">日期：<u>{{ $purchase_date }}</u></span></p>
    <table cellspacing="0" cellpadding="0" style="border-collapse:collapse; margin-left:0pt; width:800pt">
        <thead>
            <tr>
                <th style="background-color:#bfbfbf; border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:0.75pt; border-left-color:#000000; border-left-style:solid; border-left-width:0.75pt; border-right-color:#000000; border-right-style:solid; border-right-width:0.75pt; border-top-color:#000000; border-top-style:solid; border-top-width:0.75pt; padding-left:5.03pt; padding-right:5.03pt; vertical-align:middle; width:20pt"><p style="margin:5pt; text-align:center"><span style="font-family:黑体; font-size:28pt"></span></p></th>
                <th style="background-color:#bfbfbf; border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:0.75pt; border-left-color:#000000; border-left-style:solid; border-left-width:0.75pt; border-right-color:#000000; border-right-style:solid; border-right-width:0.75pt; border-top-color:#000000; border-top-style:solid; border-top-width:0.75pt; padding-left:5.03pt; padding-right:5.03pt; vertical-align:middle; width:116.55pt"><p style="margin:5pt; text-align:center"><span style="font-family:黑体; font-size:28pt">资产标签</span></p></th>
                <th style="background-color:#bfbfbf; border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:0.75pt; border-left-color:#000000; border-left-style:solid; border-left-width:0.75pt; border-right-color:#000000; border-right-style:solid; border-right-width:0.75pt; border-top-color:#000000; border-top-style:solid; border-top-width:0.75pt; padding-left:5.03pt; padding-right:5.03pt; vertical-align:middle; width:194.75pt"><p style="margin:5pt; orphans:0; text-align:center; widows:0"><span style="font-family:黑体; font-size:28pt">型号</span></p></th>
                <th style="background-color:#bfbfbf; border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:0.75pt; border-left-color:#000000; border-left-style:solid; border-left-width:0.75pt; border-right-color:#000000; border-right-style:solid; border-right-width:0.75pt; border-top-color:#000000; border-top-style:solid; border-top-width:0.75pt; padding-left:5.03pt; padding-right:5.03pt; vertical-align:middle; width:102.6pt"><p style="margin:5pt; orphans:0; text-align:center; widows:0"><span style="font-family:黑体; font-size:28pt">序列号</span></p></th>
            </tr>
        </thead>
        <tbody>
        @foreach ($assets as $asset)
            <tr>
                <td style="border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:0.75pt; border-left-color:#000000; border-left-style:solid; border-left-width:0.75pt; border-right-color:#000000; border-right-style:solid; border-right-width:0.75pt; border-top-color:#000000; border-top-style:solid; border-top-width:0.75pt; padding-left:5.03pt; padding-right:5.03pt; vertical-align:middle; width:20pt"><p style="margin:5pt; orphans:0; text-align:center; widows:0"><span style="font-family:等线; font-size:16pt">{{ $loop->iteration }}</span></p></td>
                <td style="border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:0.75pt; border-left-color:#000000; border-left-style:solid; border-left-width:0.75pt; border-right-color:#000000; border-right-style:solid; border-right-width:0.75pt; border-top-color:#000000; border-top-style:solid; border-top-width:0.75pt; padding-left:5.03pt; padding-right:5.03pt; vertical-align:middle; width:116.55pt"><p style="margin:5pt; orphans:0; text-align:center; widows:0"><span style="font-family:等线; font-size:16pt">{{ $asset->asset_tag }}</span></p></td>
                <td style="border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:0.75pt; border-left-color:#000000; border-left-style:solid; border-left-width:0.75pt; border-right-color:#000000; border-right-style:solid; border-right-width:0.75pt; border-top-color:#000000; border-top-style:solid; border-top-width:0.75pt; padding-left:5.03pt; padding-right:5.03pt; vertical-align:middle; width:194.75pt"><p style="margin:5pt; orphans:0; text-align:center; widows:0"><span style="font-family:等线; font-size:16pt">{{ $asset->model->model_number }}</span></p></td>
                <td style="border-bottom-color:#000000; border-bottom-style:solid; border-bottom-width:0.75pt; border-left-color:#000000; border-left-style:solid; border-left-width:0.75pt; border-right-color:#000000; border-right-style:solid; border-right-width:0.75pt; border-top-color:#000000; border-top-style:solid; border-top-width:0.75pt; padding-left:5.03pt; padding-right:5.03pt; vertical-align:middle; width:102.6pt"><p style="margin:5pt; orphans:0; text-align:center; widows:0"><span style="font-family:等线; font-size:16pt">{{ $asset->serial }}</span></p></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p style="margin:0pt; orphans:0; text-align:justify; widows:0"><span style="font-family:等线; font-size:10.5pt">&nbsp;</span></p>
    <p style="margin:0pt; orphans:0; text-align:justify; widows:0"><span style="font-family:等线; font-size:10.5pt">&nbsp;</span></p>
    <p style="font-size:12pt; margin-top:100px; margin-bottom: 60px; margin-right: 60px; orphans:0; text-align:right; widows:0"><span style="font-family:方正小标宋简体; font-size:24pt">经办：</span><span style="font-family:方正小标宋简体; font-size:12pt; text-decoration:underline">　　　　　　　　　　　　　　　　</span></p>
    <p style="font-size:12pt; margin-right: 60px; orphans:0; text-align:right; widows:0"><span style="font-family:方正小标宋简体; font-size:24pt">复核：</span><span style="font-family:方正小标宋简体; font-size:12pt; text-decoration:underline">　　　　　　　　　　　　　　　　</span></p>
</div>
</body>
</html>