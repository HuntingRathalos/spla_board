import { useAuthStore } from '~/stores/auth';
import { useApiFetch } from './useApiFetch';
import { User, Credentials, RegistrationInfo } from '~/types/auth';

export const useAuth = () => {
  const config = useRuntimeConfig();
  const store = useAuthStore();

  const csrfEndPoint = config.public.auth.endpoint.csrf;
  const loginEndPoint = config.public.auth.endpoint.login;
  const logoutEndPoint = config.public.auth.endpoint.logout;
  const userEndPoint = config.public.auth.endpoint.user;
  // const registerEndPoint = config.public.auth.endpoint.register;

  const login = async (credentials: Credentials) => {
    await useApiFetch(csrfEndPoint, { method: 'GET' });
    const login = await useApiFetch(loginEndPoint, {
      method: 'POST',
      body: credentials,
    });
    // if (error.value) {
    //   console.log(error.value);
    // }
    // console.log(data);
    await store.updateUser();

    return login;
  };

  const user = async (): Promise<User> => {
    const { data: user } = await useApiFetch(userEndPoint, { method: 'GET' });

    console.log(user);

    return user.value as User;
  };

  const logout = async (): Promise<void> => {
    await useApiFetch(logoutEndPoint, { method: 'POST' });
  };

  const register = async (regisrationInfo: RegistrationInfo) => {
    const register = await useApiFetch('/api/register', {
      method: 'POST',
      body: regisrationInfo,
    });

    await store.updateUser();

    return register;
  };

  return { login, user, logout, register };
};
