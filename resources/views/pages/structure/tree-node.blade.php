<li>
    <span class="col-12"
        style="{{ $node->childrenRecursive && $node->childrenRecursive->count() ? 'background: #038edc17' : '' }}">
        <div class="col-12 d-flex justify-content-between">
            <div class="click col-10">
                {{ $node->name }} | {{ $node->organizationType?->name ?? '-' }}
            </div>
            <div class="col-2 d-flex justify-content-end">
                {{-- əlavə et (+) => parent_id bu node-un id-si --}}
                <a class="btn create_new btn-sm btn-info me-1 add-custom" data-bs-target="#newOrgModal"
                    data-bs-toggle="modal" data-id="{{ $node->id }}" href="#" title="Əlavə et">
                    <i class="fas fa-plus"></i>
                </a>
                {{-- Ətraflı --}}
                <a class="btn btn-sm btn-success me-2" data-id="{{ $node->id }}" href="{{ route('structure.employee', ['id' => $node->id]) }}" title="Ətraflı">
                    <i class="fas fa-eye"></i>
                </a>
                {{-- Redaktə --}}
                <a class="edit-custom btn btn-sm btn-info me-3" data-bs-target="#editOrgModal" data-bs-toggle="modal"
                    data-id="{{ $node->id }}"
                    data-name="{{ $node->name }}"
                    data-type-id="{{ $node->organization_type_id }}"
                    data-short-name="{{ $node->short_name }}"
                    data-address="{{ $node->address }}"
                    data-email="{{ $node->email }}"
                    data-fax="{{ $node->fax }}"
                    data-phone="{{ $node->phone }}"
                    href="#" title="Redaktə et">
                    <i class="fas fa-edit"></i>
                </a>
                {{-- Aktiv switch --}}
                <div class="form-check form-switch">
                    <input class="form-check-input toggle-status" type="checkbox" id="switch-{{ $node->id }}"
                        data-id="{{ $node->id }}" {{ $node->is_active == 1 ? 'checked' : '' }}>
                    @if ($node->is_active == 1)
                        <script language="javascript">
                            document.getElementById("switch-{{ $node->id }}").checked = true;
                        </script>
                    @else
                        <script language="javascript">
                            document.getElementById("switch-{{ $node->id }}").checked = false;
                        </script>
                    @endif
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
