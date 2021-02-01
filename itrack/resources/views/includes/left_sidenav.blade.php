<ul class="list-group">
    <li class="list-group-item"><a href="/users" class="text-dark">Users</a></li>
    <li class="list-group-item"><a href="/items" class="text-dark">Items</a></li>
    <li class="list-group-item"><a href="/stocks" class="text-dark">Item Stockings</a></li>
    <li class="list-group-item"><a href="/issuings" class="text-dark">Item Issuings</a></li>
    @can('viewLogs', \App\Models\User::class)
    <li class="list-group-item"><a href="/activity_logs" class="text-dark">Activity Logs</a></li>
    @endcan

  </ul>