@extends('report.layout.default')

@section('content')
    <table>
        <thead>
        <tr>
            <th class="counter">*</th>
            <th class="left">Blueway ID / Integration ID / Origin ID</th>
            <th class="left">Customer</th>
            <th class="right">Amount</th>
            <th class="center">Status</th>
            <th class="center">Creation</th>
            <th class="center">Expired</th>
            <th class="center">Declined</th>
            <th class="center">Approved</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($collection as $index => $row)
            <tr>
                <td class="counter">{{ $index + 1 }}</td>
                <td class="left">
                    {{ \Report\property($row, 'ID') }} /<br>
                    {{ \Report\property($row, 'integrationID', '∅') }} /<br>
                    {{ \Report\property($row, 'originID', '∅') }}
                </td>
                <td class="left">{{ \Report\value($row, 'customer') }}</td>
                <td class="right">{{ \Report\valueNumber($row, 'amount') }}</td>
                <td class="center">{{ \Report\valueSelect($row, 'status', \Illuminate\Support\Facades\Lang::get('gateway/transaction/message.status')) }}</td>
                <td class="center">{{ \Report\valueDatetime($row, 'createdAt') }}</td>
                <td class="center">{{ \Report\valueDatetime($row, 'expired') }}</td>
                <td class="center">{{ \Report\valueDatetime($row, 'declined') }}</td>
                <td class="center">{{ \Report\valueDatetime($row, 'approved') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
