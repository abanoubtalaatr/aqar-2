 <table class="table table-striped">
     <thead>
         <tr>
             <th> @lang('Permission Name') </th>
             <th> @lang('index') </th>
             <th> @lang('Show') </th>
             <th> @lang('Add') </th>
             <th> @lang('Edit') </th>
             <th> @lang('Delete') </th>
         </tr>
     </thead>
     <tbody>
         @foreach ($permissions as $k => $permission)
             <tr>
                 <td> {{ $k + 1 }} . {{ __(ucfirst($permission->section)) }} </td>

                 <th> 
                    <input type="checkbox" class="index_all" name="permissions[]" value="{{'admin.' . $permission->getTranslation('section' ,'en') . '.index'}}" required
                         @if (isset($rolePermissions) && in_array('admin.' . $permission->getTranslation('section' ,'en') . '.index', $rolePermissions)) checked @endif /> 
                </th>
                 <th> 
                    <input type="checkbox" class="show_all" name="permissions[]" value="{{ 'admin.' . $permission->getTranslation('section' ,'en') . '.show' }}" required
                         @if (isset($rolePermissions) && in_array('admin.' . $permission->getTranslation('section' ,'en') . '.show', $rolePermissions)) checked @endif /> 
                </th>

                <th> <input type="checkbox" class="add_all" name="permissions[]" value="{{'admin.' . $permission->getTranslation('section' ,'en') . '.create' }}" required
                        @if (isset($rolePermissions) && in_array('admin.' . $permission->getTranslation('section' ,'en') . '.create', $rolePermissions)) checked @endif />
                </th>
                <th> <input type="checkbox" class="edit_all" name="permissions[]" value="{{ 'admin.' . $permission->getTranslation('section' ,'en') . '.update' }}" required
                         @if (isset($rolePermissions) && in_array('admin.' . $permission->getTranslation('section' ,'en') . '.update', $rolePermissions)) checked @endif />
                </th>
                <th> <input type="checkbox" class="delete_all" name="permissions[]" value=" {{ 'admin.' . $permission->getTranslation('section' ,'en') . '.destroy'  }}" required
                        @if (isset($rolePermissions) && in_array('admin.' . $permission->getTranslation('section' ,'en') . '.destroy', $rolePermissions)) checked @endif />
                </th>
             </tr>
         @endforeach
         <tr>
             <th> </th>
             <th> 
                <label> 
                    <input type="checkbox" id="index_all"
                        {{ isset($item) && count_permissions('index', $item->id) == 9 ? 'checked' : '' }} />
                    @lang('All') 
                </label>
            </th>
            <th> 
                <label> 
                    <input type="checkbox" id="show_all"
                        {{ isset($item) && count_permissions('show', $item->id) == 9 ? 'checked' : '' }} />
                    @lang('All') 
                </label>
            </th>
            <th>
                 <label>
                    <input type="checkbox" id="add_all"
                         {{ isset($item) && count_permissions('create', $item->id) == 9 ? 'checked' : '' }} />
                     @lang('All') 
                </label>
            </th>
            <th> <label><input type="checkbox" id="edit_all"
                         {{ isset($item) && count_permissions('update', $item->id) == 9 ? 'checked' : '' }} />
                     @lang('All') 
                </label>
            </th>
            <th>
                <label>
                    <input type="checkbox" id="delete_all"
                         {{ isset($item) && count_permissions('destroy', $item->id) == 9 ? 'checked' : '' }} />
                     @lang('All') 
                </label>
            </th>
         </tr>

     </tbody>
 </table>
