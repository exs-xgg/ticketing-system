@extends('layouts.app')

@section('styles')
<style media="screen">
    .mdb-feed {
        margin: 0 !important
    }

</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="post-prev-title">
                <h3>{{ $course->name }}</h3>
            </div>
            <a href="{{route('instructor.announcement.create', $course->id)}}" class="btn btn-primary my-0 mr-0"><i class="fa fa-share-square"></i> Post</a>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row mt-3 justify-content-center">
        <div class="col-lg-8 col-md-10 mb-5 pb-5">
            <div class="row px-3 d-flex justify-content-between align-items-center">
                <h3 class="text-oswald">Announcement{{count($announcements) > 1 ? 's' : ''}}</h3>
            </div>
            @if (count($announcements) > 0)
            @foreach ($announcements as $announcement)
            <div class="card my-3">
                <div class="card-body">
                    <div class="mdb-feed">
                        <div class="news">
                            <div class="label">
                                <img src="{{$announcement->instructor->avatar ? asset('storage/avatars/'.$announcement->instructor->avatar) : asset('images/profile_pic.png')}}" class="rounded-circle z-depth-1" style="height:40px;width:40px;object-fit:cover;" alt="">
                            </div>
                            <div class="excerpt mb-0">
                                <div class="brief">
                                    <p class="name blue-text my-0">{{ $announcement->instructor->name() }}</p>
                                    <div class="float-right">
                                        <a href="{{route('instructor.announcement.edit', [$course->id, $announcement->id])}}" class="thumbs mr-3 black-text" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                            <i class="fa fa-pencil blue-text"></i>
                                        </a>
                                        
                                        <a class="thumbs perma_delete" href="javascript:void(0);" data-href="{{ route('instructor.announcement.destroy', [$course->id, $announcement->id]) }}" data-method="delete" data-from="announcement" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                            <i class="fa fa-trash red-text"></i>
                                        </a>
                                    </div>
                                    <br>
                                    <div class="date pl-0">
                                        <i class="fa fa-clock-o"></i>
                                        {{ $announcement->created_at->diffForHumans() }}
                                        posted to:
                                        @foreach ($announcement->sections as $key => $section)
                                            {{$section->name}}{{ $key < count($announcement->sections) - 1 ? ', ' : ''  }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="added-text my-2">
                            {{$announcement->message}}             
                        </div>
                        @if ($announcement->image)
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#basicExampleModal{{ $announcement->id }}">
                                <img id="img-announcement" class="z-depth-1" src="{{asset('storage/images/'.$announcement->image)}}" style="height:500px; width:100%; object-fit:cover;" alt="">
                            </a>
                            <!-- Modal -->
                            <div class="modal fade" id="basicExampleModal{{ $announcement->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $announcement->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body pt-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8 text-center mb-3">
                                                    <img class="z-depth-1 img-fluid announcementImage" style="object-fit:cover;" src="{{asset('storage/images/'.$announcement->image)}}">
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mdb-feed">
                                                        <div class="news">
                                                            <div class="label">
                                                                <img src="{{$announcement->instructor->avatar ? asset('storage/avatars/'.$announcement->instructor->avatar) : asset('images/profile_pic.png')}}" class="rounded-circle z-depth-1" style="height:40px;width:40px;object-fit:cover;" alt="">
                                                            </div>
                                                            <div class="excerpt mb-0">
                                                                <div class="brief">
                                                                    <p class="name blue-text my-0">{{ $announcement->instructor->name() }}</p>
                                                                    <br>
                                                                    <div class="date pl-0">
                                                                        <i class="fa fa-clock-o"></i>
                                                                        {{ $announcement->created_at->diffForHumans() }}
                                                                        posted to:
                                                                        @foreach ($announcement->sections as $key => $section)
                                                                            {{$section->name}}{{ $key < count($announcement->sections) - 1 ? ', ' : ''  }}
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="added-text my-2">
                                                        {{$announcement->message}}             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="card my-5">
                <div class="card-body">
                    <p><i>No announcement yet</i></p>
                </div>
            </div>
            @endif
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('.modal').on('shown.bs.modal', function () {
            $('.modal').css('cssText', function(i, v) {
                return this.style.cssText + ';padding-right: 0px !important;';
            });
        })
    </script>
@endsection