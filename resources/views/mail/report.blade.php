<div>
    @if ($numReports) 
        <p>This report was sent because we have reached the $numReports amount of reports</p>
        <br>
    @endif
    <p><strong>Total Entries:</strong> {{ $entriesNum }}</p>
    <p><strong>Total entries last 24 hours:</strong>  {{ $entriesNumLastDay }}</p>
    <p><strong>Total Entries last hour: </strong> {{ $entriesNumLastHour }}</p>
    <p><strong>Top 10 IP:</strong></p>
        @foreach ($mostCommonIp as $ip)
            @if ($ip->count > 1)
                <p>{{ $ip->ip }}</p>
            @endif
        @endforeach
    <p><strong>Top 10 User Agent:</strong></p>
        @foreach ($mostCommonUserAgent as $agent)
            @if ($agent->count > 1)
                <p>{{ $agent->useragent }}</p>
            @endif
        @endforeach

</div>