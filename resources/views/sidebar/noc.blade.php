@if (Auth::user()->department == 'cc')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            Noc Links <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="btn" href="{{ url('/newJobEntry') }}">Enter New Job</a>
            </li>
            <li>
                <a class="btn" href="{{ url('listOnGoingJobs') }}">On-going Jobs</a>
            </li>
            <li>
                <a class="btn" href="{{ url('listFinishedJobs') }}">Finished Jobs</a>
            </li>
        </ul>
    </li>
@else
    <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        Work Links <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a class="btn" href="{{ url('/newJobEntry') }}">Enter New Job</a>
        </li>
        <li>
            <a class="btn" href="{{ url('listOnGoingJobs') }}">On-going Jobs</a>
        </li>
        <li>
            <a class="btn" href="{{ url('listFinishedJobs') }}">Finished Jobs</a>
        </li>
        @if (auth()->user()->user_type == 'admin')
            <li>
                <a class="btn" href="{{ url('/addNewConsumer') }}">New Consumer</a>
            </li>
        @endif
    </ul>
</li>
@endif
