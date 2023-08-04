import { useApiFetch } from './useApiFetch';
import { useParty } from '~/composables/party';

export const useUser = () => {
  const config = useRuntimeConfig();

  const join = async (partyId: number, friend_code: number): Promise<void> => {
    const { data } = await useApiFetch(`/api/users/join`, {
      method: 'POST',
      body: {
        partyId,
        friend_code,
      },
    });
    useParty().getParties();
  };

  return { join };
};
