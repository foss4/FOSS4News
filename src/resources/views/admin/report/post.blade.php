@extends('admin.layout')
@section('content-admin')
    <div class="row  mb-4 m-0 px-3 justify-content-center">
        <div class="card m-1 border-danger">
            <div class="card-header">تعداد گزارش‌ها</div>
            <div class="card-body pr-1 pl-1 p-0 justify-content-center row">
                <span class="text-danger pl-1 pr-1">{{num_to_fa($reports_count)}}</span>
            </div>
        </div>
    </div>

    @if($last_page !=1 )
        <div class="row justify-content-center">
            <nav>
                <ul class="pagination mb-4 m-0 p-0">
                    <li class="page-item">
                        <a class="page-link" href="?page={{($current_page > 1)? $current_page-1:'1'}}"
                           aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for($i=1 ; $i <= $last_page ; $i++)
                        <li class="page-item {{($i == $current_page)? 'active':''}}">
                            <a class="page-link" href="?page={{$i}}">{{num_to_fa($i)}}</a>
                        </li>
                    @endfor

                    <li class="page-item">
                        <a class="page-link" href="?page={{($current_page < $last_page)? $current_page+1:$last_page}}"
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group text-right">
                @foreach($reports as $index=>$report)
                    <li class="list-group-item">
                        <div class="row post text-right mr-0 ml-0">
                            <div class="col-12 post-body">
                                <h2>
                                    <span class="text-secondary number">
                                        {{ num_to_fa($index + 1) }}
                                    </span>
                                    .
                                    {{$report->body}}
                                </h2>
                                <h3 class="text-secondary">
                                    <a href="{{route('show_post',['post'=>$report->reportable])}}">
                                        <span class="badge badge-dark ltr">
                                            {{'#'.$report->reportable->uri}}
                                        </span>
                                    </a>
                                    <span class="badge badge-danger ltr">
                                            {{'#'.$report->reason}}
                                    </span>
                                    |
                                    {{ num_to_fa(\Morilog\Jalali\Jalalian::forge($report->created_at)->ago()) }}
                                    |
                                    <span>
                                        {{$report->User->name}}
                                    </span>
                                    |
                                    <a href="{{route('post.delete',['post'=>$report->reportable])}}"
                                       class="text-danger">
                                        حذف پست
                                    </a>
                                    |
                                    <a href="{{route('admin.reports.delete',['report'=>$report])}}" class="text-dark">
                                        حذف گزارش
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
