import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react'
import { setCredentials } from './authSlice'
import { Navigate,useNavigate } from 'react-router-dom'

const baseQuery = fetchBaseQuery({
    baseUrl: process.env.REACT_APP_API_BASE_URL,
    prepareHeaders: (headers, { getState }) => {
        const token = getState().auth.token
        console.log("Sending request");
        if (token) {
            headers.set("authorization", `Bearer ${token}`)
        }
        return headers
    }
})

const baseQueryWithReauth = async (args, api, extraOptions) => {
    let result = await baseQuery(args, api, extraOptions)
    console.log(result?.error?.status);
    if ((result?.error?.status === 403)) {
        console.log('sending refresh token');
        // send refresh token to get new access token 
        const refreshResult = await baseQuery({
            url: `/api/auth/refresh`,
            method: `GET`, 
            headers: {
                'Accept': 'Application/json'
              }
          }, api, extraOptions)
    
          console.log(refreshResult);
          if (refreshResult?.data) {
            const user = api.getState().auth.user 
            // store the new token 
            api.dispatch(setCredentials({ ...refreshResult.data, user }))
            // retry the original query with new access token 
            result = await baseQuery(args, api, extraOptions)
        } else {
            api.dispatch(logOut())
        }
    }else if((result?.error?.status === 401)){      
        api.dispatch(logOut());
        // send refresh token to get new access token 
       
    }
    return result
}

export const apiSlice = createApi({
    baseQuery: baseQueryWithReauth,
    endpoints: builder => ({})
})