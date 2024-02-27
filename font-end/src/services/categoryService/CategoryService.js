import axios from "axios";

export default {
    GetCategory(){
        return axios.get("category/GetAllCategory");
    },

    AddCategory(res){
        let data =new FormData();
        data.append('photo',res.photo);
        data.append('description',res.description);
        const config={
            Headers:{
                "content-Type":'multipart/form-data',
            },
        };
        return axios.post('category/AddCategory',data,config);
    },
    deleteCategory(id){
        return axios.delete(`category/DeleteCategory/${id}`);
    },
    UpdateCategory(res,id){
        let data =new FormData();
        data.append('photo',res.photo);
        data.append('description',res.description);
        const config={
            Headers:{
                "content-Type":'multipart/form-data',
            },
        };
        return axios.post(`category/UpdateCategory/${id}`,data,config);
    },
}