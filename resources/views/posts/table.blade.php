<div class="table-responsive">
    <table class="table" id="posts-table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Categories</th>
            <th>Date</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ $post->created_at }}</td>
                <td class='font-weight-bold'> 
                    {{ $post->status }}
                </td>
                <td width="120">
                    @if ($post->status !== 'Trash')
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('posts.show', [$post->id]) }}"
                            class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('posts.edit', [$post->id]) }}"
                            class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            @if (Auth::user()->role !== 'author')
                                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            @endif
                            
                        </div>
                        {!! Form::close() !!}
                    @endif 
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
