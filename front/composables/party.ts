import { usePartyStore } from '~/stores/party';
import { useApiFetch } from './useApiFetch';
import { Party } from '~/types/party';

export const useParty = () => {
  const config = useRuntimeConfig();
  const store = usePartyStore();

  const getParty = async (id: number): Promise<Party> => {
    const { data: party } = await useApiFetch(`/api/parties/${id}`, { method: 'GET' });
    // await store.setParty(party.value);
    console.log(party);
    return party.value as Party;
    // return party.value;
  };

  const getParties = async (): Promise<void> => {
    const { data: parties } = await useApiFetch('/api/parties', { method: 'GET' });
    console.log(parties.value);
    await store.setParties(parties.value);

    // return parties.value;
  };
  // const getMyParty = async (id: number): Promise<void> => {
  //   const { data: party } = await useApiFetch(`/api/parties/${id}`, { method: 'GET' });
  //   await store.setParty(party.value);

  //   // return party.value;
  // };
  const createParty = async (createPartyForm: any): Promise<void> => {
    const { data: party } = await useApiFetch('/api/parties', { method: 'POST', body: createPartyForm });
    await store.createParty(party.value);

    // return party.value;
  };

  const updateParty = async (updatePartyForm: any): Promise<void> => {
    const { data: party } = await useApiFetch(`/api/parties/${updatePartyForm.id}`, {
      method: 'PUT',
      body: updatePartyForm,
    });
    console.log(party.value);
    await store.updateParty(party.value);

    // return party.value;
  };

  const deleteParty = async (id: number): Promise<void> => {
    const { data: party } = await useApiFetch(`/api/parties/${id}`, { method: 'DELETE' });
    // const id = party.value?.id
    await store.deleteParty(id);

    // return party.value;
  };
  return { getParties, getParty, createParty, updateParty, deleteParty };
};
