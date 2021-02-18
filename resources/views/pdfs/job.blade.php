<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Job PDF</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>

    <body class="font-sans antialiased">

        @foreach($jobs as $page => $job)
            <div class="p-9">
                <div class="row border-bottom mb-3">
                    <div class="col-4">
                        <p class="text-left text-bold text-italic">
                            {{ $job->date_formatted_uk }}
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="text-center text-bold text-italic">
                            {{ $page + 1 . "/" . count($jobs) }}
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="text-right text-bold text-italic">
                             EPMG Ltd - Invoice
                        </p>
                    </div>
                </div>

                <div class="row mb-3 pb-3">
                    <div class="col-4 col-offset-4 text-center">
{{--                        <img src="{{ asset('/images/logo.png') }}" alt="logo">--}}
                    </div>
                </div>

                <div class="row border-bottom mb-3 pb-3">
                    <div class="col-8">
                        <h2>
                            Customer Details
                        </h2>

                        <p>
                            Invoice Number: {{ $job->invoice_number }}
                        </p>

                        <p>
                            Booking Time: {{ $job->time }}
                        </p>

                        <p>
                            Booking Date: {{ $job->date_formatted_uk }}
                        </p>

                        <p>
                            Booking Name: {{ $job->name }}
                        </p>

                        <p>
                            Job Address: {{ $job->address }}
                        </p>

                        <p>
                            Job Postcode: {{ $job->postcode }}
                        </p>

                        <p>
                            Job Type: {{ $job->type->name }}
                        </p>

                        <p>
                            Engineer Assigned: {{ $job->engineer }}
                        </p>

                        <p>
                            First hour authorised to engineer excluding VAT: {{ "£$job->first_hour_cost" }}
                        </p>

                        <p>
                            Booking made with staff member: {{ $job->created_by }}
                        </p>
                    </div>
                    <div class="col-4">
                        <h2>
                            EPHG Limited
                        </h2>

                        <p>
                            Parkgates Bury New Road
                        </p>

                        <p>
                            Prestwich
                        </p>

                        <p>
                            Manchester
                        </p>

                        <p>
                            Company Number: 9559055
                        </p>

                        <p>
                            VAT Number: 193455484
                        </p>

                        <p>
                            Contact Number: 07720247247
                        </p>

                        <p>
                            Website: https://ephg.limited
                        </p>
                    </div>
                </div>

                <div class="row border-bottom mb-3 pb-3">
                    <div class="col-6">
                        <h2>
                            Description
                        </h2>

                        <p>
                            {{ $job->information }}
                        </p>
                    </div>
                </div>

                <div class="row border-bottom mb-3 pb-3">
                    <div class="col-8">
                        <h2>
                            Other Fees
                        </h2>

                        <p class="mb-3">
                            Any other fees authorised <br>
                            should be on a separate <br>
                            invoice from the contractor/engineer
                        </p>

                        <p>
                            Please refer to the price plan page at: <br>
                            https://ephg.limited/price-plan.html
                        </p>
                    </div>
                    <div class="col-4">
                        <h2>
                            EPHG Fees
                        </h2>

                        <p>
                            Call Out/Booking Fee: {{ "£$job->booking_fee" }}
                        </p>

                        <p>
                            VAT: {{ "£$job->vat" }}
                        </p>

                        <p class="mb-3">
                            Total: {{ "£$job->total" }}
                        </p>

                        <h3>
                            {{ $job->status->name }}
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h3>
                            Terms
                        </h3>

                        <p>
                            All terms are agreed prior & during the booking at https://ephg.limited & the booking starts upon EPHG sending a receipt.<br>
                            All fees paid are NON-Refundable under the limitations agreement subject to 'urgent repairs & maintenance". <br>
                            This also means that the service given can not be cancelled, however, the contractor can be cancelled from turning up. <br>
                            Any official complaints MUST be made to martin@ephg.limited quoting the invoice number above.
                        </p>
                    </div>
                </div>
            </div>


            @if($page + 1 < count($jobs))
                <div class="page-break"></div>
            @endif
        @endforeach
    </body>

    <style>
        *{
            box-sizing: border-box;
            word-wrap: break-word;
            word-break: break-word;
        }

        :after, :before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        html,body
        {
            width: 100%;
            height: 100%;
            margin: 0;
            font-family: sans-serif;
            background-color: #d9d9d9;
        }

        .page-break {
            page-break-before: always;
        }

        .row{
            margin-right: -15px;
            margin-left: -15px;
        }

        .row:before, .row:after {
            display: table;
            content: " ";
        }

        .row:after {
            clear: both;
        }

        div[class^="col-"]
        {
            position: relative;
            min-height: 1px;

            float: left;
        }

        .col-4
        {
            width: 33.33333333%;
        }

        .col-offset-4 {
            margin-left: 33.33333333%;
        }

        .col-8
        {
            width: 66.66666667%;
        }

        .col-6
        {
            width: 50%;
        }

        .col-12
        {
            width: 100%;
        }

        .text-left
        {
            text-align: left;
        }

        .text-center
        {
            text-align: center;
        }

        .text-right
        {
            text-align: right;
        }

        .p-9
        {
            padding: 3rem;
        }

        .pb-3
        {
            padding-bottom: 1rem;
        }

        .mb-3
        {
            margin-bottom: 1rem;
        }

        h1, h2, h3, h4, h5, p
        {
            margin-block-start: 0;
            margin-block-end: 0;
            margin-inline-start: 0;
            margin-inline-end: 0;
        }

        h1, h2, h3, h4, h5
        {
            font-size: 16px;
            margin-bottom: 1rem;
        }

        p
        {
            font-size: 12px;
            margin: 0 0 .25rem;
        }

        .border-bottom
        {
            border-bottom: solid 1px darkgray;
        }

        .text-bold
        {
            font-weight: bold;
        }

        .text-italic
        {
            font-style: italic;
        }
    </style>
</html>
