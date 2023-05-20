<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{(__('userrole.userrole'))}}</h1>
                <button type="button" class="btn-close addrole" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" id="user_role">
                    @csrf
                    <div class="mb-3">

                        <input type="hidden" class="form-control" id="id" aria-describedby="emailHelp"
                            name="id">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{(__('userrole.code'))}}</label>
                        <input type="text" class="form-control" id="idd" aria-describedby="emailHelp"
                            name="idd">
                        <p class="error-info">

                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{(__('userrole.des1'))}}</label>
                        <input type="text" class="form-control" id="des" aria-describedby="emailHelp"
                            name="des">

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{(__('userrole.des2'))}}</label>
                        <input type="text" class="form-control" id="des2" aria-describedby="emailHelp"
                            name="des2">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">{{(__('userrole.action'))}}</label>
                        {{-- <input type="text" class="form-control" id="active" aria-describedby="emailHelp" name="active"> --}}
                        <select name="active" id="active" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No"></option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{(__('userrole.close'))}}</button>
                <button type="button" class="btn btn-primary adduser">{{(__('userrole.addnew'))}}</button>
                <button type="button" class="btn btn-success editebu">{{(__('userrole.clickedit'))}}</button>
            </div>
        </div>
    </div>
</div>
@yield('userrole')
