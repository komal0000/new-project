@extends('admin.layout.app')
@section('header-Links')
    <a href="{{ route('admin.setting.index') }}">Setting</a>
    <a href="{{ route('admin.setting.contact.index') }}">Contact</a>
@endsection
@section('active', 'setting')
@section('content')
    <div class="shadow mt-2 p-3 bg-white rounded">
        <div class="row mb-2">
            <div class="col-md-4 mb-2">
                <label for="cname">Name</label>
                @if ($contact)
                    <input type="text" name="cname" id="cname" class="form-control" value="{{ $contact->name }}"
                        required>
                @else
                    <input type="text" name="cname" id="cname" class="form-control" required>
                @endif
            </div>
            <div class="col-md-4 mb-2">
                <label for="address">address</label>
                @if ($contact)
                    <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address }}"
                        required>
                @else
                    <input type="text" name="address" id="address" class="form-control" required>
                @endif

            </div>
            <div class="col-md-4 mb-2">
                <label for="phone">Phone No</label>
                @if ($contact)
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}"
                        required>
                @else
                    <input type="text" name="phone" id="phone" class="form-control" required>
                @endif

            </div>
            <div class="col-md-4 mb-2">
                <label for="po_box">P.O.Box</label>
                @if ($contact)
                    <input type="text" name="po_box" id="po_box" class="form-control" value="{{ $contact->po_box }}"
                        required>
                @else
                    <input type="text" name="po_box" id="po_box" class="form-control" required>
                @endif
            </div>
            <div class="col-md-4 mb-2">
                <label for="email">Email</label>
                @if ($contact)
                    <input type="text" name="email" id="email" class="form-control" value="{{ $contact->email }}"
                        required>
                @else
                    <input type="text" name="email" id="email" class="form-control" required>
                @endif
            </div>
            <div class="col-12">
                <button class="btn btn-primary" onclick="saveAll()">
                    Save Contact
                </button>
            </div>

        </div>
    </div>
    <div class="shadow mt-2 p-3 bg-white rounded">
        <div class="row">
            <div class="col-12">
                <label for="contact_info" class="form-label"><strong>Contact Information Details</strong></label>
                <textarea name="contact_info" id="contact_info" class="form-control note">{!! $contactSetting->data ?? '' !!}</textarea>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function saveAll() {
            var cname = $('#cname').val();
            var address = $('#address').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var po_box = $('#po_box').val();
            var contact_info = $('#contact_info').val();

            const data = {
                cname: cname,
                address: address,
                phone: phone,
                email: email,
                po_box: po_box,
                contact_info: contact_info,
            };

            axios.post('{{ route('admin.setting.contact.index') }}', data)
                .then(res => {
                    success('successfully Updated');
                })
                .catch(err => {
                    console.error(err);
                });
        };
    </script>
@endsection
