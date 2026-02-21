<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>

<h1>Business Performance Report</h1>

<h2>Revenue Overview</h2>
<table>
    <tr><th>Month</th><th>Total</th></tr>
    @foreach($months as $month)
        <tr>
            <td>{{ $month->month }}</td>
            <td>${{ number_format($month->total, 2) }}</td>
        </tr>
    @endforeach
</table>

<h2>Top Clients</h2>
<table>
    <tr><th>Client</th><th>Total Revenue</th></tr>
    @foreach($topClients as $client)
        <tr>
            <td>{{ $client->name }}</td>
            <td>${{ number_format($client->total_revenue, 2) }}</td>
        </tr>
    @endforeach
</table>

<h2>Project Status</h2>
<table>
    <tr><th>Active</th><th>Completed</th><th>On Hold</th></tr>
    <tr>
        <td>{{ $activeProjects }}</td>
        <td>{{ $completedProjects }}</td>
        <td>{{ $onHoldProjects }}</td>
    </tr>
</table>

<h2>Payment Status</h2>
<table>
    <tr><th>Paid</th><th>Pending</th><th>Overdue</th></tr>
    <tr>
        <td>${{ number_format($paid, 2) }}</td>
        <td>${{ number_format($pending, 2) }}</td>
        <td>${{ number_format($overdue, 2) }}</td>
    </tr>
</table>

<h2>Time Breakdown</h2>
<table>
    <tr><th>Billable</th><th>Non-billable</th><th>Total</th></tr>
    <tr>
        <td>{{ $billableHours }}h</td>
        <td>{{ $nonBillableHours }}h</td>
        <td>{{ $billableHours + $nonBillableHours }}h</td>
    </tr>
</table>

</body>
</html>