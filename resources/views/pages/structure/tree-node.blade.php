<li>
    <span class="col-12"
        style="{{ $node->childrenRecursive && $node->childrenRecursive->count() ? 'background: #038edc17' : '' }}">
        <div class="col-12 d-flex justify-content-between">
            <div class="click col-9">
                {{ $node->name }} | {{ $node->organizationType?->name ?? '-' }}
            </div>
            <div class="col-3 d-flex justify-content-end">
                @if(in_array($node->organization_type_id, [1, 2]))
                <a class="btn btn-sm btn-success me-1"
                    href="{{ route('structure.staff-table', $node->id) }}">
                    <i class="bi bi-file-earmark-text"></i>
                </a>
                @endif
                {{-- əlavə et (+) => parent_id bu node-un id-si --}}
                <a class="btn create_new btn-sm btn-info me-1 add-custom"
                    data-bs-target="#newOrgModal"
                    data-bs-toggle="modal"
                    data-id="{{ $node->id }}" href="javascript:void\(0\)" title="Əlavə et">
                    <i class="fas fa-plus"></i>
                </a>
                {{-- Ətraflı --}}
                <a class="btn btn-sm btn-success me-1"
                    data-id="{{ $node->id }}"
                    href="{{ route('structure.employee', ['id' => $node->id]) }}"
                    title="Ətraflı">
                    <i class="fas fa-eye"></i>
                </a>
                {{-- Redaktə --}}
                <a class="edit-custom btn btn-sm btn-info me-1" data-bs-target="#editOrgModal" data-bs-toggle="modal"
                    data-id="{{ $node->id }}"
                    data-name="{{ $node->name }}"
                    data-type-id="{{ $node->organization_type_id }}"
                    data-short-name="{{ $node->short_name }}"
                    data-address="{{ $node->address }}"
                    data-email="{{ $node->email }}"
                    data-fax="{{ $node->fax }}"
                    data-phone="{{ $node->phone }}"
                    href="javascript:void\(0\)"
                    title="Redaktə et">
                    <i class="fas fa-edit"></i>
                </a>
                {{-- Aktiv switch --}}
                <div class="form-check form-switch d-flex align-items-center justify-content-center">
                    <input class="form-check-input toggle-status me-1"
                        type="checkbox"
                        data-id="{{ $node->id }}"
                        {{ $node->is_active == 1 ? 'checked' : '' }}>

                    <label class="form-check-label" for="switch-{{ $node->id }}">
                        Aktiv
                    </label>
                </div>
            </div>
        </div>
    </span>
    @if ($node->childrenRecursive && $node->childrenRecursive->count())
    <ul style="display: none;">
        @foreach ($node->childrenRecursive as $child)
        @include('pages.structure.tree-node', ['node' => $child])
        @endforeach
    </ul>
    @endif
</li>