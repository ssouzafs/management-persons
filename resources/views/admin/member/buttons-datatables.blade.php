<div class="d-flex align-items-center">
    <a href="{{ route('admin.edit', ['id' => $admin->id]) }}"
       class="btn btn-sm text-white bg-primary icon-pencil-square-o icon-notext mx-2" title="Editar"
       alt="Editar"> Editar
    </a>

    <a href="javascript:void(0)" class="btn btn-sm text-white bg-danger icon-trash icon-notext ajax_delete"
       title="Deletar" alt="Deletar"
       data-id="{{ $admin->id }}"
       data-action="{{ route('admin.destroy', ['id' => $admin->id]) }}"
    > Deletar</a>
</div>
