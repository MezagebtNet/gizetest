@if ($batch)
    <div class="card card-outline card-secondary">
        <div class="card-header">
            Batch Details
            <div class="card-tools">


                <!-- Collapse Button -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
            </div>

        </div>
        <div class="card-body ">
            {{-- <ul class="list-group list-group-flush">
                <li class="list-group-item"> --}}
                @if (isset($batch))
                    <span><strong>ID: </strong>{{ $batch->id }}</span><br/>
                    <span><strong>Code Name: </strong>{{ $batch->code_name }}</span><br/>
                    <span><strong>Description: </strong>{{ $batch->description }}</span><br/>
                    <span><strong>Fee: </strong>{{ $batch->payment_fee.' '.$batch->currency }}</span><br/>
                    <span><strong>Start Date: </strong>{{ $batch->starts_on_date }}</span><br/>
                    <span><strong>Status: </strong>{{ $batch->status_name }}</span><br/>
                    <span><strong>Subscription Type: </strong>{{ $batch->subscription_type_name }}</span><br/>
                    <span><strong>Last Period: </strong>#{{ $batch->max_period_no }} - {{ $batch->max_period_name }}</span><br/>
                @endif
                    {{-- </li>
              </ul> --}}

        </div>
    </div>

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
                <li class="list-group-item"><a href="{{ route('admin.manage.batch.editform', ['gize_channel_id' => $batch->gize_channel_id, 'id' => $batch->id]) }}">Edit Batch Details</a></li>
            </ul>
        </div>
    </div>
@endif
