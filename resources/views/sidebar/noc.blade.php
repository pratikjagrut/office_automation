<!--Left side navbar menu-->
<div id="sidebar">
    <ul>
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
</div>