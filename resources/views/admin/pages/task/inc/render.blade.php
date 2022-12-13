<div class="row">
    <div class="col-md-8">
        <h3><b>{{$item->title}}</b></h3>
        <p><b>Layihə:</b> {{$item->project}}</p>
        <hr>

        <p><strong>Açıqlama:</strong> {{$item->description}}</p>
        <div class="row">
            <hr>
            <div class="col-md-12">
             
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item " role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab"
                            aria-selected="false" tabindex="-1">
                            Təhkim olunanalar
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#product1" role="tab"
                            aria-selected="false" tabindex="-1">
                            Fayllar
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#profile-1" role="tab"
                            aria-selected="false" tabindex="-1">
                           Şərhlər
                        </a>
                    </li>
                </ul>
          
                <div class="tab-content  text-muted">
                    <div class="tab-pane active show" id="home" role="tabpanel">
                        <ul class="list-unstyled vstack gap-3 mb-0">
                            @foreach ($item->users as $person)

                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('admin/assets/images/users/avatar-10.jpg') }}"
                                            alt="" class="avatar-xs rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-1"><a href="javascript:void(0);">{{$person->full_name}}</a>
                                        </h6>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-icon btn-sm fs-16 text-muted dropdown"
                                                type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ri-more-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu" style="">
                                                {{-- <li><a class="dropdown-item"
                                                        href="javascript:void(0);"><i
                                                            class="ri-eye-fill text-muted me-2 align-bottom"></i>View</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="javascript:void(0);"><i
                                                            class="ri-star-fill text-muted me-2 align-bottom"></i>Favourite</a>
                                                </li> --}}
                                                <li><a class="dropdown-item"
                                                        href="javascript:void(0);"><i
                                                            class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Təhkim olunalardan çıxar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                       
                        </ul>
                    </div>
                    <div class="tab-pane" id="product1" role="tabpanel">
                        <div class="vstack gap-2">
                            @foreach ($item->files as $file)
                                
                          
                            <div class="border rounded border-dashed p-2">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <div
                                                class="avatar-title bg-light text-secondary rounded fs-24">
                                                <i class="ri-file-ppt-2-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="fs-13 mb-1"><a href="javascript:void(0);"
                                                class="text-body text-truncate d-block">{{$file->name}}</a></h5>
                                        <div>Tip: {{$file->type}}</div>
                                    </div>
                                    <div class="flex-shrink-0 ms-2">
                                        <div class="d-flex gap-1">
                                            <a href="{{$file->path}}" type="button"
                                                class="btn btn-icon text-muted btn-sm fs-18"><i
                                                    class="ri-download-2-line"></i></a>

                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-icon text-muted btn-sm fs-18 dropdown"
                                                    type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    {{-- <li><a class="dropdown-item"
                                                            href="javascript:void(0);"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Rename</a></li> --}}
                                                    <li><a class="dropdown-item"
                                                            href="javascript:void(0);"><i
                                                                class="ri-delete-bin-fill align-bottom me-2 text-muted " data-id="{{$file->id}}" route="{{route('task.destroy','destroy')}}"></i>
                                                            Sil</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="profile-1" role="tabpanel">
                        <div data-simplebar="init" style="height: 508px;" class="px-3 mx-n3 mb-2">
                            <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" id="scrollable"   tabindex="0"
                                            role="region" aria-label="scrollable content"
                                            style="height: 100%; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 0px 16px;" id="comments-box">
                                               
                                                @foreach($item->commnets  as $comment)
                                                <div class="d-flex mb-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{asset('admin/assets/images/users/avatar-7.jpg')}}"
                                                            alt="" class="avatar-xs rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-13"><a
                                                                href="pages-profile.html">{{$comment->user->name}}</a> <small class="text-muted">{{$comment->created_at}}</small></h5>
                                                        <p class="text-muted">{{$comment->content}}</p>

                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: auto; height: 574px;">
                                </div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal"
                                style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;">
                                </div>
                            </div>
                            <div class="simplebar-track simplebar-vertical"
                                style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 449px; transform: translate3d(0px, 0px, 0px); display: block;">
                                </div>
                            </div>
                        </div>
                        <form class="mt-4" id="comment-form">
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label for="exampleFormControlTextarea1" class="form-label">Şərh yaz</label>
                                    <textarea class="form-control bg-light border-light" id="coment-text"
                                        id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Şərh yaz..."></textarea>
                                </div>
                                <!--end col-->
                                <div class="col-12 text-end">
                                    <a href="javascript:void(0);" id="comment" class="btn btn-success">Şərh yaz</a>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                        <input type="hidden" id="task-id" value="{{$item->id}}">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mb-4 align-items-center">
                    <div class="flex-shrink-0">
                        <img src="http://127.0.0.1:8000/admin/assets/images/users/avatar-3.jpg" alt=""
                            class="rounded-circle avatar-md">
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h5 class="card-title mb-1">{{$item->user->full_name}}</h5>
                        {{-- <p class="text-muted mb-0">Design</p> --}}
                        <a href="#" class="badge badge-outline-primary" style="color:{{$item->status->color}}">{{$item->status->name}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <strong class="pr-2">Başlama vaxdı:</strong>
                <span>{{$item->start}}</span>

            </div>
            <div class="col-md-12 ">
                <strong class="pr-2">Bitmə vaxdı:</strong>
                <span>{{$item->deadline}}</span>

            </div>
            <div class="col-md-12">
                <strong class="pr-2">Prioritet:</strong>
                <span style="color: {{$item->priority->color}} ">{{$item->priority->name}}</span>
            </div>
           
        </div>
    </div>
</div>
