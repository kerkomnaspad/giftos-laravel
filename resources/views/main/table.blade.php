<!-- <table class="table">
    <thead>
        <tr>
            @foreach ($columns as $column)
                <th scope="col">
                    {{ucfirst($column)}}
                </th>

            @endforeach

        </tr>
    </thead>
    <tbody>
    @foreach ($data as $row)
        <tr>
            @foreach ($columns as $column )
                <td>{{$row->$column}}</td>
            @endforeach
        </tr>
    @endforeach
        
    </tbody>
</table> -->