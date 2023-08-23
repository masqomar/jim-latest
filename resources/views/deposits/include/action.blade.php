<td>
  @can('setoran simpanan view')
  <a href="{{ route('deposits.show', $model->id) }}" class="btn btn-outline-success btn-sm">
    <i class="fa fa-eye"></i>
  </a>
  @endcan
  @can('setoran simpanan edit')
  <a href="{{ route('deposits.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
    <i class="fa fa-pencil-alt"></i>
  </a>
  @endcan
  @can('setoran simpanan delete')
  <form action="{{ route('deposits.destroy', $model->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure to delete this record?')">
    @csrf
    @method('delete')

    <button class="btn btn-outline-danger btn-sm">
      <i class="ace-icon fa fa-trash-alt"></i>
    </button>
  </form>
  @endcan
</td>