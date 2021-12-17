<div class="activity-feed">
    @foreach($tasks->activity()->orderBy('id', 'desc')->get() as $activity)
        <div class="feed-item">
            <div class="activity-date">{{date('l, d-m-Y H:i:s', strtotime($activity->created_at))}}</div>
            <div class="activity-text">{{$activity->text}}</div>
        </div>
    @endforeach
</div>
