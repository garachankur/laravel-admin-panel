
<div class="content-header row">
    <div class="content-header-left {{ (isset($actionButtons) && count($actionButtons)) ? 'col-md-6' : 'col-md-12' }} col-12 mb-2">
        <h3 class="content-header-title">{{ (isset($module_name)) ? $module_name : ''}}</h3>
        @if(isset($breadcrumb) && count($breadcrumb))
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                        @foreach($breadcrumb as $key => $breadcrumbItem)
                            @if (isset($breadcrumbItem['url']) && !empty($breadcrumbItem['url']) && !$loop->last)
                                <li class="breadcrumb-item"><a href="{{$breadcrumbItem['url']}}">{{$breadcrumbItem['title']}}</a></li>
                            @else
                                <li class="breadcrumb-item active">{{$breadcrumbItem['title']}}</li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        @endif
    </div>

    @if(isset($actionButtons) && count($actionButtons))
        <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                @foreach($actionButtons as $singleActionBtn)
                    <a href="{{ (isset($singleActionBtn['url'])) ? $singleActionBtn['url'] : 'javascript:void(0)' }}" class="btn {{ (isset($singleActionBtn['class'])) ? $singleActionBtn['class'] : 'btn-success' }}  round  " id="{{ (isset($singleActionBtn['id'])) ? $singleActionBtn['id'] : '' }}" > {{ (isset($singleActionBtn['title'])) ? $singleActionBtn['title'] : '' }} </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
