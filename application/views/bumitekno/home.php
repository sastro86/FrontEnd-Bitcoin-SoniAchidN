<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <style type="text/css">

        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 14px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        #menu {
            float: right;
            margin-top: 0%;
            margin-right: 15px;
        }

        #menu ul {
            list-style: none;
        }

        #menu ul li a {
            text-decoration: none;
            padding: 3px;
        }

        #menu ul li a:hover {
            color: red;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body {
            margin: 0 15px 0 15px;
        }

        p.footer {
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }

        .ttl {
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            margin-bottom: 30px;
        }

        table.tbl {
            margin: 15px auto;
            border-spacing: 0px;
        }

        table.tbl thead {
            text-align: center;
        }

        table.tbl th {
            border-bottom: 1px solid #ccc;
        }

        table.tbl th, table.tbl td {
            padding: 3px 10px;
            border-width: 1px 1px 0px 0px;
            border-color: #ccc;
            border-style: solid;
        }

        table.tbl td, table.tbl_konvert td:last-child {
            text-align: right;
        }

        table.tbl td:first-child {
            font-weight: bold;
            text-align: left;
        }

        table.tbl tr:last-child td {
            border-bottom: 1px solid #ccc;
        }

        table.tbl th:first-child, table.tbl td:first-child {
            border-left: 1px solid #ccc;
        }

        .center {
            margin: auto;
        }

        input {
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<div id="container">
    <div id="head">
        <div id="menu">
            <ul>
                <li>
                    <a href="pertama">Pertama</a>
                    <a href="kedua">Kedua</a>
                    <a href="ketiga">Ketiga</a>
                </li>
            </ul>
        </div>
        <h1>Welcome to CodeIgniter!</h1>
    </div>

    <div id="body">
        <?php $this->load->view($page); ?>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
</div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    'use strict';

    !function (a) {
        'function' == typeof define && define.amd ? define(['jquery'], a) : a(
            'object' == typeof exports ? require('jquery') : jQuery);
    };

    $(document).ready(function () {
        'use strict';

        if ($('table#infoBTC').length) {
            $.ajax({
                type: 'GET',
                datatype: 'json',
                url: 'https://blockchain.info/ticker',
            }).done(function (msg, status) {
                var htm = '';
                $.each(msg, function (index, element) {
                    console.log(index)
                    htm += '<tr><td>' + index + '</td><td>' + element.buy + '</td><td>' + element.sell + '</td></tr>';
                });
                $('table#infoBTC tbody').empty().append(htm);
            });
        }

        if ($('#konversiBTC').length) {
            $(document).on('keyup mouseup', 'input#check', function () {
                var c = $(this).val();
                var p = 14000;

                if (c.length > 0 && parseInt(c) > 0) {
                    var ToDlr = (parseInt(c) / p).toFixed(5);
                    $.ajax({
                        type: 'GET',
                        url: 'https://blockchain.info/tobtc?currency=USD&value=' + ToDlr,
                    }).done(function (msg, status) {
                        console.log(msg)
                        $('span#key').text(c);
                        $('span#value').text(ToDlr);

                        $('span#value_1').text(msg);
                    });
                } else {
                    $('span#key').text('');
                    $('span#value').text('');
                    $('span#key_1').text('');
                    $('span#value_1').text('');
                }
            });
        }

        if ($('#konversiRP').length) {
            $(document).on('keyup mouseup', 'input#check', function () {
                var c = $(this).val();
                var p = 14000;
                var BtcToUSD = '';

                if (c.length > 0 && parseInt(c) > 0) {
                    $.ajax({
                        type: 'GET',
                        datatype: 'json',
                        url: 'https://blockchain.info/ticker',
                    }).done(function (msg, status) {
                        BtcToUSD = msg.USD.last;
                        BtcToUSD = parseFloat(msg.USD.last) * c;

                        $('span#key').text(c);
                        $('span#value').text(BtcToUSD);
                        $('span#value_1').text((parseFloat(BtcToUSD) * p));
                    });
                } else {
                    $('span#key').text('');
                    $('span#value').text('');
                    $('span#key_1').text('');
                    $('span#value_1').text('');
                }
            });
        }
    });
</script>
</html>