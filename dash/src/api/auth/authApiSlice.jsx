import { apiSlice } from "../../featuers/apiSlice"

export const authApiSlice = apiSlice.injectEndpoints({
    endpoints: builder => ({
        login: builder.mutation({
            query: credentials => ({
                url: '/api/auth/login',
                method: 'POST',
                body: { ...credentials },
                headers: {
                    'Accept': 'Application/json'
                  }  
            })
        }),
        sendForgotPassword: builder.mutation({
            query: credentials => ({
                url: '/api/auth/forgot-password',
                method: 'POST',
                body: { ...credentials },
                headers: {
                    'Accept': 'Application/json'
                  }  
            })
        }),
        resetPassword: builder.mutation({
            query: (formData)  => ({
                url: '/api/auth/reset-password',
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'Application/json'
                  }  
            })
        }),
        verifyResetToken: builder.query({
            query: (invite_token) => ({
                url: `/api/auth/verify-reset-token?reset_token=${invite_token}`,
                method: 'GET',
                headers: {
                    'Accept': 'Application/json'
                  }          
            })
           
        })
    })
})

export const {
    useLoginMutation,useSendForgotPasswordMutation,useResetPasswordMutation,useVerifyResetTokenQuery
} = authApiSlice