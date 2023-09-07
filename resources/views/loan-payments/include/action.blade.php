<td>
    @can('bayar angsuran view')
    <a href="{{ route('loan-payments.show', $model->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    @endcan
   
</td>