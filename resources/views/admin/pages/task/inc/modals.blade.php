
<div class="modal fade zoomIn" id="new-task-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="" id="">Yeni Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form  id="new-task-form" enctype="multipart/form-data">
                @csrf
               
                <div class="modal-body">
                    <input type="hidden" id="tasksId" />
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="projectName-field" class="form-label">Project Adı</label>
                            <input type="text" id="project" name="project" class="form-control" placeholder="Project name" required />
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="tasksTitle-field" class="form-label">Başlıq</label>
                                <input type="text" id="title"  name="title" class="form-control" placeholder="Title" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="projectName-field" class="form-label">Açıqlama</label>
                            <textarea name="description" id="description" cols="30"  class="form-control" required placeholder="Açıqlama" rows="5"></textarea>
                        </div>
                        <!--end col-->
                     
                        <!--end col-->
                        <div class="col-lg-12">
                            <label class="form-label">Təhkim et</label>
                            <div data-simplebar style="height: 95px;">
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                    @foreach ($users as $user)
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3 user_id" type="checkbox" name="user_id[]" value="{{$user->id}}"  multiple>
                                            <label class="form-check-label d-flex align-items-center" for="anna-adame">
                                                <span class="flex-shrink-0">
                                                    <img src="{{asset('admin/assets/images/users/avatar-3.jpg')}}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">
                                                   {{ $user->full_name}}
                                                </span>
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                             
                                </ul>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label for="duedate-field" class="form-label">Başlama vaxdı</label>
                            <input type="date" id="start" name="start"  class="form-control"  placeholder="Due date" required />
                        </div>
                        <div class="col-lg-6">
                            <label for="duedate-field" class="form-label">Dedline</label>
                            <input type="date" id="deadline" name="deadline" class="form-control"  placeholder="Due date" required />
                        </div>
                        <!--end col-->

                        <div class="col-lg-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status_id" class="form-control"  id="status_id">
                                <option value="">Status</option>
                                @foreach ($statuses as $status)
                                  <option value="{{$status->id}}">{{$status->name}}</option>
                                  @endforeach
                            </select>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label  for="priority-field" class="form-label">Vaciblik</label>
                            <select name="priority"  class="form-control" id="priority">
                                <option value="">Vaciblik</option>
                                <option value="1">Yüksək</option>
                                <option value="2">Orta</option>
                                <option value="3">Aşağı</option>
                            </select>
                        </div>
                        <div class="col-ls-12">
                            <label  for="priority-field" class="form-label">Fayl </label>
                            <input type="file" id="file" name="file[]" class="form-control" multiple >
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">İmtina et</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Task Əlavet</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade zoomIn" id="edit-task-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="" id="">Task Düzənlə</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="#" id="edit-task-form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="tasksId" />
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="projectName-field" class="form-label">Project Adı</label>
                            <input type="text" id="edit-project" name="project" class="form-control" placeholder="Project name" required />
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="tasksTitle-field" class="form-label">Başlıq</label>
                                <input type="text" id="edit-title"  name="title" class="form-control" placeholder="Title" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="projectName-field" class="form-label">Açıqlama</label>
                            <textarea name="description" id="edit-description" cols="30"  class="form-control" required placeholder="Açıqlama" rows="5"></textarea>
                        </div>
                        <!--end col-->
                     
                        <!--end col-->
                        <div class="col-lg-12">
                            <label class="form-label">Təhkim et</label>
                            <div data-simplebar style="height: 95px;">
                                <ul class="list-unstyled vstack gap-2 mb-0">
                                    @foreach ($users as $user)
                                    <li>
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-3 edit_user_id" type="checkbox" id="edit_user_id" name="user_id[]" value="{{$user->id}}" >
                                            <label class="form-check-label d-flex align-items-center" for="anna-adame">
                                                <span class="flex-shrink-0">
                                                    <img src="{{asset('admin/assets/images/users/avatar-3.jpg')}}" alt="" class="avatar-xxs rounded-circle">
                                                </span>
                                                <span class="flex-grow-1 ms-2">
                                                   {{ $user->full_name}}
                                                </span>
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                             
                                </ul>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label  class="form-label">Başlama vaxdı</label>
                            <input type="date"  name="start"   class="form-control edit-start"  placeholder="Başlama vaxdı" autocomplete="off" required />
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Dedline</label>
                            <input type="date" id="edit-deadline"  name="deadline" class="form-control" autocomplete="off" placeholder="Dedline" required />
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label for="ticket-status1" class="form-label">Status</label>
                            <select name="status_id" class="form-control"  id="edit-status">
                                <option value="">Status</option>
                                @foreach ($statuses as $status)
                                  <option value="{{$status->id}}">{{$status->name}}</option>
                                  @endforeach
                            </select>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <label  for="priority-field" class="form-label">Vaciblik</label>
                            <select name="priority"  class="form-control" id="edit-priority">
                                <option value="">Vaciblik</option>
                                <option value="1">Yüksək</option>
                                <option value="2">Orta</option>
                                <option value="3">Aşağı</option>
                            </select>
                        </div>
                        <input type="hidden" id="edit-id" name="id">

                        <div class="col-ls-12">
                            <label  for="priority-field" class="form-label">Fayl </label>
                            <input type="file" name="file[]" id="edit-file" class="form-control" multiple >
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">İmtina et</button>
                        <button type="button" class="btn btn-success" id="update-btn">Task Düzənlə</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!--end delete modal -->
