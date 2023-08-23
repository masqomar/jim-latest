<td>
    @can('bayar angsuran view')
    <a href="{{ route('loan-payments.show', $model->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    @endcan
    @can('bayar angsuran edit')
    <a href="{{ route('loan-payments.edit', $model->id) }}" class="btn btn-outline-primary btn-sm">
        <i class="fa fa-pencil-alt"></i>
    </a>
    @endcan
    @can('bayar angsuran delete')
    <form action="{{ route('loan-payments.destroy', $model->id) }}" method="post" class="d-inline" onsubmit="return confirm('Are you sure to delete this record?')">
        @csrf
        @method('delete')

        <button class="btn btn-outline-danger btn-sm">
            <i class="ace-icon fa fa-trash-alt"></i>
        </button>
    </form>
    @endcan
</td>