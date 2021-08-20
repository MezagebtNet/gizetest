    <div class="card card-outline card-secondary">
        <div class="card-header">
            Shortcuts
            <div class="card-tools">


                <!-- Collapse Button -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
            </div>

        </div>
        <div class="card-body px-0 py-0">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ route('admin.manage.batch.index') }}">List of Batches</a></li>
                @if (isset($batch))

                    <li class="list-group-item"><a
                            href="{{ route('admin.manage.batch.subscription.index', $batch->id) }}">Edit
                            Subscriptions</a></li>
                @endif
            </ul>
        </div>
    </div>
