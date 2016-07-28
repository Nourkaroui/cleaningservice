

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th></th>
            <th>Driver name</th>
            <th>Joined</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        @if($user->role =='drive')
        <tr>
            <td class="text-center">
                <form method="post" action="{{ route('admin.delete', $user->id) }}" class="delete_form_user">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button id="delete-user-btn">
                        <i class="material-icons red-text">delete_forever</i>
                    </button>
                </form>
            </td>
            <td>
                {{ $user->username }}
            </td>
            <td>
                {{ prettyDate($user->created_at) }}
            </td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>