<div class="mt-2 btn-group btn-group-sm" role="group" aria-label="Admin Action">
    {{-- <a href="#" class="first btn btn-primary edit"> Content</a> --}}
    {{-- <a href="{{ route('admin.sections.faq.index',$section->uuid) }}" class="first btn btn-primary edit"> Faq</a> --}}
    {{-- @can('update', $admin) --}}
    <a href="{{ route('admin.test-drive-enquiries.show',$testdrive->id) }}" class="first btn btn-primary edit"><i class="fas fa-eye"
            data-toggle="tooltip" title="View"></i></a>
   
</div>
