@foreach($subcategories as $subcategory)
        <tr data-id="{{$subcategory->id}}" data-parent="{{$dataParent}}" data-level = "{{$dataLevel + 1}}">
            <td data-column="name">{{$subcategory->name}}</td>
        </tr>
	    @if(count($subcategory->subcategory))
            @include('admin.category.subCategoryView',['subcategories' => $subcategory->subcategory, 'dataParent' => $subcategory->id, 'dataLevel' => $dataLevel ])
        @endif
@endforeach


<select name="parent_id" id=""  class="form-control" >
                                <option value="">Select parent</option>
                                @foreach($parentCategories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @if(count($category->subcategory))
                                @include('admin.category.subCategoryView',['subcategories' => $category->subcategory, 'dataParent' => $category->id , 'dataLevel' => 1])
                                @endif
                                @endforeach
                            </select>