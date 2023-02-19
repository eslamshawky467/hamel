<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="invoice.css"></head>
<body style="padding: 3rem">
                <div class="text-center">
</div>
    <h1>Report Ghazal</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Users</th>
                  <th>Trips</th>
                <th>Trips Finished</th>
                  <th>Profits</th>
            

            </tr>
        </thead>
        <tr>
            <tbody>
            <td>{{$countclient}}</td>
            <td>{{$countrequest}}</td>
              <td>{{$count}}</td>
            <td class="text-end">{{$money}}</td>
        </tbody>
        </tr>
    </table>
</body>
</html>