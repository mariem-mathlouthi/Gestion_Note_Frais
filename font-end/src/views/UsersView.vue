<template>
  <div>
    <div class="card">
        <div class="card-header">
            <h4>Users</h4>
            <Router-link to="/user/create" class="btn btn-primary" float-end>Add user</Router-link>
        </div>
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <Router-link :to="{ name: 'user-edit', params: { id: user.id } }" class="btn btn-warning">Edit</Router-link>
                            <button class="btn btn-danger" @click="deleteUser(user.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    
    
    </div>

  </div>
</template>