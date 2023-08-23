<td>
    <a href="{{ route('account-types.show', $model->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>

    <a href="{{ route('account-types.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
      <i class="fa fa-pencil-alt"></i>
    </a>

    <form action="{{ route('account-types.destroy', $model->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure to delete this record?')">
        @csrf
        @method('delete')

        <button class="btn btn-outline-danger btn-sm">
          <i class="ace-icon fa fa-trash-alt"></i>
        </button>
    </form>
</td>
